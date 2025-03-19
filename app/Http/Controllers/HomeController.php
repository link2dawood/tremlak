<?php

namespace App\Http\Controllers;

use App\Models\BrokerOffices;
use Illuminate\Http\Request;
use App\Models\BuyCredits;
use App\Models\city;
use App\Models\ContactUs;
use App\Models\Notifications;
use App\Models\Languages;
use App\Models\Currency;
use App\Models\Property;
use App\Models\UseCredits;
use App\Models\User;
use App\Models\Message;
use App\Models\Visitors;
use App\Notifications\CreditLossNotification;
use App\Notifications\PropertyNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\GoogleAnalyticsService;
use App\Models\Visitor;
class HomeController extends Controller
{
    public function admin_dashboard(GoogleAnalyticsService $analyticsService){
        $notifications=Notifications::where('user_id',Auth::user()->id)->get();
        $properties=Property::where('user_id',Auth::user()->id)->get();
        $users_new=User::where('user_type',0)->where('approve_profile',0)->get();
        $users=User::where('user_type',0)->get();
        $agencies=BrokerOffices::all();
        $messages=ContactUs::all();
        // $todayVisitors = $analyticsService->getTodayVisitors();
        // Get today's visitors count
        $todayVisitors = $analyticsService->getTodayVisitors();
                            return view('admin.pages.index',compact('notifications','properties','users_new','messages','agencies','users','todayVisitors'));

                        }

// public function analytics(GoogleAnalyticsService $analyticsService){
//      $todayVisitors = $analyticsService->getTodayVisitors();
//      $visitorsByCountry = $analyticsService->getVisitorsByCountry();
//      return view('admin.pages.analytics', compact('todayVisitors', 'visitorsByCountry'
//      ));
//  }
                        public function analytics(GoogleAnalyticsService $analyticsService)
                        {
                            $todayVisitors = $analyticsService->getTodayVisitors();
                            $visitorsByCountry = $analyticsService->getVisitorsByCountry();
    $visitorsByDate = $analyticsService->getVisitorsByDate(); // Fetch from Google Analytics

    return view('admin.pages.analytics', compact('todayVisitors', 'visitorsByCountry', 'visitorsByDate'));
}


public function getVisitorsByDate($date, GoogleAnalyticsService $analyticsService)
{
    // Fetch visitors data from Google Analytics
    $visitorsByCountry = $analyticsService->getVisitorsByCountryForDate($date);

    return response()->json($visitorsByCountry);
}



public function downloadVisitors(GoogleAnalyticsService $analyticsService)
{
    // Fetch visitors grouped by date
    $visitorsByDate = $analyticsService->getVisitorsByDate();

    // Define the CSV filename
    $fileName = 'visitors_by_date_' . date('Y-m-d') . '.csv';

    // Set CSV headers
    $headers = [
        "Content-type"        => "text/csv",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma"              => "no-cache",
        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        "Expires"             => "0"
    ];

    // Open file stream
    $callback = function () use ($visitorsByDate) {
        $file = fopen('php://output', 'w');

        // Add CSV column headers
        fputcsv($file, ['ID', 'Date', 'Total Visitors']);

        $id = 1;
        foreach ($visitorsByDate as $visitor) {
            fputcsv($file, [$id++, $visitor['visit_date'], $visitor['total_visitors']]);
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}


public function dashboard(){


    $notifications=Notifications::where('user_id',Auth::user()->id)->get();
    $properties=Property::where('user_id',Auth::user()->id)->get();


    return view('dashboard.dashboard',compact('notifications','properties'));

}
public function sendMessage(Request $request)
{
        // dd($request->all());
    try {
        $message = new Message();
        $message->agent_id = $request->agent_id;
        $message->contact_method = $request->contact_method;
        $message->contact = $request->contact;
        $message->inquiry = $request->inquiry;
        $message->is_read = $request->is_read;
        $message->property_id = $request->property_id;
        $message->language = implode(', ', $request->language);
        // dd($message);
        $message->save();

        return response()->json(['success' => true, 'message' => 'Message sent successfully!']);

    } catch (\Exception $e) {
        \Log::error("Error in sendMessage: " . $e->getMessage());
        return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
    }
}
public function markAsRead(Request $request)
{
   $message = \App\Models\Message::find($request->id);

   if ($message) {
    $message->is_read = true;
    $message->save();

    return redirect()->back()->with(['success' => true, 'message' => 'Message Mark as Read!']);
}

return redirect()->back()->with('error', 'Message not found!');
}
public function getUnreadCount()
{
    $unreadCount = \App\Models\Message::where('agent_id', auth()->id())
    ->where('is_read', false)
    ->count();

    return response()->json(['count' => $unreadCount]);
}

public function messages()
{
    $user_id = Auth::user()->id;
    $messages = Message::with('property')->where('agent_id', $user_id)->orderBy('created_at', 'desc')->get();
    return view('dashboard.agent_messages', compact('messages'));
}
public function index(){

    $cities=city::where('status',1)->where('show_on_home','true')->orderBy('position','ASC')->get();

    $properties=Property::where('status',1)
    ->where('expire_status',0)
    ->where('admin_status',1)
    ->whereHas('property_agent', function ($query) {
        $query->where('status', 1);
    })
    ->orderBy('id','DESC')->get();
    $featured_properties=Property::where('status',1)
    ->where('expire_status',0)
    ->where('admin_status',1)
    ->where('highlight','true')
    ->whereHas('property_agent', function ($query) {
        $query->where('status', 1);
    })
    ->orderBy('id','DESC')->take(10)->get();
    $language_global = Languages::where('status', 1)->orderBy('id', 'DESC')->get();
    $currency_global = Currency::where('status', 1)->orderBy('id', 'DESC')->get();

    // Set default values (Turkish language & currency)
    $langs = $language_global->where('short_name', 'tr')->first();
    $curren = $currency_global->where('code', 'TRY')->first();
    return view('pages.index',compact('cities','properties','featured_properties','language_global', 'currency_global', 'langs', 'curren'));

}

public function expire_credits()
{

    $today = Carbon::today()->format('Y-m-d');
    $users = User::where('user_type', 0)->get();

    foreach ($users as $user) {

        $used= UseCredits::where('user_id', $user->id)->sum('amount');
        $expired= BuyCredits::whereRaw("STR_TO_DATE(expire_date, '%d-%m-%Y') < ?", [$today])->where('user_id', $user->id)->sum('amount');

        if($expired > $used){

            $remain=$expired - $used;
            if ($user->balance >= $remain) {

                DB::beginTransaction();
                $user->balance -= $remain;
                    $user->save(); // Save the updated user balance

                    $data=[
                        'name'=>$user->name,
                        'subject'=>'Credit Expired',
                        'message'=>"Your credits are expired, credit amount is ".$remain." Please check your new balance.",
                    ];
                    DB::commit();
                    $user->notify(new CreditLossNotification($data));

                }

            }

        }

//        return "Expired successfully";
    }
    public function expire_property()
    {
        $today = Carbon::today()->format('Y-m-d');
        $properties = Property::whereRaw("STR_TO_DATE(expire_date, '%d-%m-%Y') < ?", [$today])->get();


        foreach ($properties as $property) {
            $user = User::where('id', $property->user_id)->first();

            DB::beginTransaction();

            $property_obj = Property::where('id', $property->id)->first();
            $property_obj->expire_status = 1;
            $property_obj->save(); // Save the updated property status

            $data=[
                'name'=>$user->name,
                'subject'=>'Property expire',
                'message'=>"Your property is expired, property number is ".$property->slug." Please check you properties.",
            ];
            DB::commit();
            $user->notify(new PropertyNotification($data));

        }

//        return "Expired successfully";
    }

}
