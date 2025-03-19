<?php

namespace App\Http\Controllers;

use App\Models\BuyCredits;
use App\Models\CreditDiscount;
use App\Models\CreditPackage;
use App\Models\settings;
use App\Models\Notifications;
use App\Models\SocialLinks;
use App\Models\UseCredits;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Stripe\Customer;
use Stripe\Stripe;
use Carbon\Carbon;
use App\Models\CreditHistory;
use App\Models\EmailSetting;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\StreamedResponse;
class TransactionsController extends Controller
{
    //admin side
    public function credits_overview(){
        try{

            $BuyCredits = BuyCredits::orderBy('id','DESC')->get();
            $UseCredits = UseCredits::orderBy('id','DESC')->get();
            $CreditHistory = CreditHistory::orderBy('id','DESC')->get();

            return view('admin.pages.credits_overview', compact('BuyCredits','UseCredits', 'CreditHistory'));

        }   catch (\Throwable $th){

            dd("Something went wrong, please try again!");

        }
    }
    public function credits_assign()
    {
        try {
            $BuyCredits = BuyCredits::orderBy('id', 'DESC')->get();
            $UseCredits = UseCredits::orderBy('id', 'DESC')->get();
            $agents = User::where('user_type', 0)->orderBy('id', 'DESC')->get(); // Fetch all agent users

            return view('admin.pages.credits_assign', compact('BuyCredits', 'UseCredits', 'users'));

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong, please try again!');
        }
    }
    public function assignCredits(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'agent_ids' => 'required|array',
                'credits' => 'required|integer|min:1',
            ]);

            foreach ($validatedData['agent_ids'] as $agentId) {
                $user = User::find($agentId);
                if ($user) {
                    $user->increment('balance', $validatedData['credits']);

                // Log credit assignment in history
                    CreditHistory::create([
                        'user_id' => $agentId,
                        'credits' => $validatedData['credits'],
                        'description' => 'Admin assigned credits',
                    ]);
                    Notifications::create([
                        'user_id' => $agentId,
                        'subject' => 'Admin Sent You Credits',
                        'message' => 'The Admin has sent you ' . $validatedData['credits'] . ' credits.',
                    'create_date' => Carbon::now(), // Save the current timestamp
                ]);
                }
            }

            return redirect()->back()->with('success', 'Credits assigned successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to assign credits.');
        }
    }
    public function viewAgentBalance($id)
    {
        $agent = User::where('id', $id)->where('user_type', 0)->select('id', 'fname', 'lname', 'email', 'balance')->first();
        $CreditHistory = CreditHistory::where('user_id', $id)->get();
        if (!$agent) {
            return redirect()->back()->with('error', 'Agent not found.');
        }

        return view('admin.pages.agent_balance', compact('agent', 'CreditHistory'));
    }

    public function exportAgentCredits($id)
    {
        $agent = User::where('id', $id)->where('user_type', 0)->first();

        if (!$agent) {
            return redirect()->back()->with('error', 'Agent not found');
        }

        $fileName = "agent_{$agent->id}_credits.csv";

        $response = new StreamedResponse(function () use ($agent) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'Agent Name', 'Credits']);
            fputcsv($handle, [$agent->id, $agent->fname . ' ' . $agent->lname, $agent->balance]);
            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $fileName . '"');

        return $response;
    }
    public function exportCredits()
{
    $filename = "brokers_credits_list.csv";

    $credits = BuyCredits::with(['agent', 'package.package_details'])->get();

    $headers = [
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=$filename",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0"
    ];

    $callback = function() use ($credits) {
        $file = fopen('php://output', 'w');
        fputcsv($file, [
            'ID', 'Payment Type', 'First Name', 'Last Name', 'Email', 'Company Name', 
            'Tax Number', 'Agent Info', 'Package', 'Amount Paid', 'Buy Date', 'Expiry Date'
        ]);

        foreach ($credits as $buy) {
            fputcsv($file, [
                $buy->id,
                $buy->payment_type,
                $buy->fname,
                $buy->lname,
                $buy->email,
                $buy->company_name,
                $buy->tax_number,
                ($buy->agent->fname ?? '') . ' ' . ($buy->agent->lname ?? ''),
                ($buy->package->package_details[0]->title ?? '') . ' - ' . ($buy->package->credits ?? ''),
                $buy->amount,
                date('d-m-Y', strtotime($buy->create_date)),
                date('d-m-Y', strtotime($buy->expire_date))
            ]);
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}
    //user side
    public function index(){
        try{

            $BuyCredits = BuyCredits::where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
            $UseCredits = UseCredits::where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
            $packages=CreditPackage::where('status',1)->orderBy('credits','ASC')->get();
            $discounts=CreditDiscount::where('status',1)->orderBy('discount','ASC')->get();

            return view('dashboard.credits', compact('packages','discounts','BuyCredits','UseCredits'));

        }   catch (\Throwable $th){

            dd("Something went wrong, please try again!");

        }
    }

    public function buy_credits(Request $request)
    {
        try {
            $rules = [

                'package_id' => ['required','exists:credit_packages,id'],
            ];

            // Create a validator instance
            $validator = Validator::make($request->all(), $rules);

            // Perform the validation
            if ($validator->fails()) {
                // Redirect back with errors if validation fails
                $errors = $validator->errors()->first();

                return response()->json(['status' => 'false','icon'=>'error', 'message' => $errors]);
            }

            $settings=settings::where('id',1)->first();
            DB::beginTransaction();
            Stripe::setApiKey($settings->STRIPE_SECRET_KEY);

            $token = $request->input('token');
            $package_id = $request->input('package_id');
            $currency = 'TRY';

            $package=CreditPackage::where('id',$package_id)->where('status',1)->first();

            if(!$package){
                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('agent.The selected credit package is not found')]);
            }

            $buy_amount=$package->price;

            //get the discount if it exist
//            $discount =CreditDiscount::where('package_id', $package_id)->where('status', 1)->value('discount');
//
//            if($discount && $discount > 0 ){
//
//                $discountAmount = ($discount / 100) * $buy_amount;
//                $buy_amount -= $discountAmount;
//            }

            // Charge the customer
            $charge = \Stripe\Charge::create([
                'amount' => $buy_amount * 100,
                'currency' => $currency,
                'source' => $token,
                'description' => 'Credits Purchase',
            ]);
            \Log::info('Stripe Charge Response: ' . json_encode($charge));
            // Handle the charge success
            if ($charge->status === 'succeeded') {

                $currentDate = date('d-m-Y');

                $settings=settings::where('id',1)->first();
                $days=$settings->credit_expiration_days;

                $trans = BuyCredits::create([
                    'user_id' => Auth::user()->id,
                    'payment_type' => $request->payment_type ?? '',
                    'fname' => $request->fname ?? '',
                    'lname' => $request->lname ?? '',
                    'email' => $request->email ?? '',
                    'company_name' => $request->company_name ?? '',
                    'tax_number' => $request->tax_number ?? '',
                    'amount' => $buy_amount,
                    'package_id' => $package_id,
                    'discount' => 0,
                    'currency' => strtoupper($currency),
                    'expire_date' => date('d-m-Y', strtotime($currentDate . ' +'.$days.' days')),
                    'create_date' => date('d-m-Y')
                ]);
                $user = Auth::user();
                $user->balance += $package->credits;
                $user->save();

                DB::commit();
                CreditHistory::create([
                    'user_id' => Auth::user()->id,
                    'credits' => $package->credits,
                    'description' => 'Purchased credits',
                ]);
                Notifications::create([
                    'user_id' => Auth::user()->id,
                    'subject' => 'Purchase credits',
                    'message' => 'You have Purchase ' . $package->credits . ' credits.',
                    'create_date' => Carbon::now(), // Save the current timestamp
                ]);

             // Fetch Email Settings
                $emailSettings = EmailSetting::first();

    // Prepare order details
                $items = [
                    (object) ['name' => $package->title, 'price' => $package->price]
                ];
                $tax = 0.00; // Update if applicable
                $total = $package->price + $tax;
                // dd($request->email);
                // Send invoice email
                Mail::to($request->email)->send(new InvoiceMail($user, $package, $emailSettings, $items, $tax, $total));
                        // Send Invoice Email
                        // Mail::to($user->email)->send(new InvoiceMail($trans, $package, $user));
                return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('agent.Credit added successfully')]);
            } else {
                DB::rollBack();
                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('agent.Failed to credit')]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            \Log::error('Stripe Payment Exception: ' . $th->getMessage());
            return response()->json(['status' => 'false', 'icon' => 'error', 'message' => $th->getMessage()]);
        }

    }

    public function get_discounted_credits(Request $request){
        try{

            $package_id=$request->package_id;
            $package=CreditPackage::where('id',$package_id)->where('status',1)->first();

            if(!$package){
                return response()->json(['status' => false, 'result' => 'Package not found']);
            }

            $buy_amount=$package->credits;
            $amount=$package->credits;


            $discount = CreditDiscount::where('package_id', $package_id)->where('status', 1)->value('discount');

            if($discount && $discount > 0 ){

                $discountAmount = ($discount / 100) * $buy_amount;
                $buy_amount -= $discountAmount;
            }

            return response()->json(['status' => true, 'result' => $buy_amount]);

        }   catch (\Throwable $th){

            return response()->json(['status' => false, 'result' => 'Exception']);
        }
    }

}
