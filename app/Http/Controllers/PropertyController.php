<?php

namespace App\Http\Controllers;

use App\Models\ApartmentAttribute;
use App\Models\BuildingAttribute;
use App\Models\city;
use App\Models\Currency;
use App\Models\DescriptionTemplate;
use App\Models\dynamic_form;
use App\Models\FeaturesCategory;
use App\Models\filled_dynamic_form;
use App\Models\HouseAttribute;
use App\Models\LandAttribute;
use App\Models\Location;
use App\Models\Features;
use App\Models\Property;
use App\Models\PropertyDescription;
use App\Models\PropertyImage;
use App\Models\propertyType;
use App\Models\town;
use App\Models\settings;
use App\Models\Transaction;
use App\Models\Notifications;
use App\Models\UseCredits;
use App\Models\User;
use App\Notifications\PropertyNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class PropertyController extends Controller
{
    
    //admin side
    public function admin_properties(Request $request)
    {
        
        try {
            
            $properties = Property::with('property_type')
            ->with('property_agent')
            ->with('property_town')
            ->with('property_city')
            ->with('property_district')
            ->with('property_images')
            ->with('property_details')
            ->orderBy('id', 'DESC')->get();
            
            return view('admin.pages.properties', compact(
                'properties'
            ));
        } catch (\Throwable $th) {
            
            dd("Something went wrong, please try again!");
        }
    }
    public function updateAdminStatus(Request $request)
    {
        try {
            $id = $request->id;
            DB::beginTransaction();
            $user = Property::findorfail($id);
            $user->admin_status = $request->status;
            
            if (!$user->update()) {
                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Failed to update Property status')]);
            }
            DB::commit();
            return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Property status updated successfully')]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception to update Property status')]);
        }
    }
    public function updateFeaturedStatus(Request $request)
    {
        try {
            $id = $request->id;
            DB::beginTransaction();
            $user = Property::findorfail($id);
            $user->featured = $request->status;
            
            if (!$user->update()) {
                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Failed to update Property status')]);
            }
            DB::commit();
            return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Property status updated successfully')]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception to update Property status')]);
        }
    }
    
    public function index(Request $request, $agent_id = '')
    {
        try {
            // Initialize agent variable
            $data['agent'] = null;
            $today = Carbon::today()->format('d-m-Y');
            // dd($today);
            // Initialize base query
            $query = Property::with([
                'property_agent',
                'property_town',
                'property_city',
                'property_district',
                'property_images',
                'property_details'
            ])
            ->where('status', 1)
            ->where('expire_status', 0)
            ->where('admin_status', 1)->whereRaw("STR_TO_DATE(expire_date, '%d-%m-%Y') >= ?", [Carbon::today()->format('Y-m-d')]);
    
            // Apply all filters first before sorting
            if ($agent_id) {
                $data['agent'] = User::where('id', $agent_id)
                    ->where('status', 1)
                    ->where('approve_profile', 1)
                    ->first();
    
                if (!$data['agent']) {
                    return back();
                }
                $query->where('user_id', $agent_id);
            }
    
            // Apply property type filters
            if ($request->filled('type_id_index')) {
                $query->where('property_type_id', $request->type_id_index);
                $this->applyPropertyTypeFilters($query, $request, $request->type_id_index);
            }
    
            // Apply location filters
            if ($request->filled('city_id')) {
                $query->where('city_id', $request->city_id);
            }
    
            if ($request->filled('town_id')) {
                $query->where('town_id', $request->town_id);
            }
    
            if ($request->filled('district_id')) {
                $query->where('district_id', $request->district_id);
            }
    
            // Price range filter
            if ($request->filled('min_price')) {
                $min_price = str_replace('.', '', $request->min_price);
                $query->where('price_in_usd', '>=', $min_price);
            }
    
            if ($request->filled('max_price')) {
                $max_price = str_replace('.', '', $request->max_price);
                $query->where('price_in_usd', '<=', $max_price);
            }
    
            // Location proximity filter
            if ($request->filled('location_ids_with_values')) {
                $locationValues = $request->location_ids_with_values;
                $query->where(function($q) use ($locationValues) {
                    foreach ($locationValues as $value) {
                        list($locationId, $proximityValue) = explode('-', $value);
                        $q->orWhere(function($sq) use ($locationId, $proximityValue) {
                            $sq->whereJsonContains('location_ids', $locationId)
                               ->whereJsonContains('location_values', $proximityValue);
                        });
                    }
                });
            }
    
            // Apply sorting last
            $sort_by = $request->input('sort_by', 0);
            switch ($sort_by) {
                case 1: // Oldest
                    $query->orderByRaw('STR_TO_DATE(create_date, "%d-%m-%Y") ASC');
                    break;
                case 2: // Price Low to High 
                    $query->orderBy('price_in_usd', 'ASC');
                    break;
                case 3: // Price High to Low
                    $query->orderBy('price_in_usd', 'DESC');
                    break;
                default: // Newest (default)
                    $query->orderByRaw('STR_TO_DATE(create_date, "%d-%m-%Y") DESC');
            }
    
            // Store filter values in data array
            $data['type_id_index'] = $request->input('type_id_index');
            $data['city_id'] = $request->input('city_id'); 
            $data['town_id'] = $request->input('town_id');
            $data['district_id'] = $request->input('district_id');
            $data['min_price'] = $request->input('min_price');
            $data['max_price'] = $request->input('max_price');
            $data['sort_by_search'] = $request->input('sort_by', 0);
            
            // Store property specific filters
            if ($request->filled('type_id_index')) {
                switch($request->type_id_index) {
                    case 1: // Apartment
                        $data['apartment_type'] = $request->input('apartment_type', []);
                        $data['apartment_conditionp'] = $request->input('apartment_conditionp', []);
                        $data['apartment_elevator'] = $request->input('apartment_elevator');
                        $data['min_apartment_grossm2'] = $request->input('min_apartment_grossm2');
                        $data['max_apartment_grossm2'] = $request->input('max_apartment_grossm2');
                        break;
                    case 2: // Villa
                        $data['villa_conditionp'] = $request->input('villa_conditionp', []);
                        $data['villa_elevator'] = $request->input('villa_elevator');
                        $data['min_villa_grossm2'] = $request->input('min_villa_grossm2');
                        $data['max_villa_grossm2'] = $request->input('max_villa_grossm2');
                        break;
                    // ...add other property types similarly...
                }
            }
    
            // Store location filters
            if ($request->filled('location_ids_with_values')) {
                $data['location_ids_with_values'] = $request->location_ids_with_values;
            }
    
            // Get paginated results with all filters and sorting applied
            $data['properties'] = $query->paginate(20)->withQueryString();
            
            // Pass all necessary data to view
            $data['sort_by_search'] = $sort_by;
            $data['propertyType'] = propertyType::where('status', 1)->orderBy('title', 'ASC')->get();
            $data['outlooks'] = FeaturesCategory::where('status', 1)->orderBy('title', 'ASC')->get();
            $data['locations'] = Location::where('status', 1)->orderBy('title', 'ASC')->get();
    
            return view('pages.listing', $data);
    
        } catch (\Throwable $th) {
            dd("Something went wrong: " . $th->getMessage());
        }
    }
    
    public function details($sulg = '')
    {
        $outlooks_category = FeaturesCategory::where('status', 1)->orderBy('title', 'ASC')->get();
        $property = Property::with('property_agent')
        ->where('status', 1)
        ->where('expire_status', 0)
        ->where('admin_status', 1)
        ->where('slug', $sulg)
        ->whereHas('property_agent', function ($query) {
            $query->where('status', 1);
            $query->where('approve_profile', 1);
        })
        ->first();
        if (!$property) {
            return redirect()->route('/');
        }
        $property->visitors += 1;
        $property->save();
        $similars = Property::with('property_type')
        ->with('property_agent')
        ->with('property_town')
        ->with('property_city')
        ->with('property_district')
        ->with('property_images')
        ->with('property_details')
        ->where(function ($query) use ($property) {
            $query->where('property_type_id', $property->property_type_id)
            ->orWhere('city_id', $property->city_id)
            ->orWhere('town_id', $property->town_id)
            ->orWhere('district_id', $property->district_id)
            ->orWhere('user_id', $property->user_id);
        })
        ->where('id', '!=', $property->id) // Exclude the property being viewed
        ->where('status', 1)
        ->where('expire_status', 0)
        ->where('admin_status', 1)
        ->whereHas('property_agent', function ($query) {
            $query->where('status', 1);
            $query->where('approve_profile', 1);
        })
        ->orderBy('id', 'DESC')
        ->take(10)
        ->get();
        
        return view('pages.property-details', compact('property', 'similars', 'outlooks_category'));
    }
    public function my_properties()
    {
        try {
            $properties = Property::with('property_type')->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
            if ($properties) {
                return view('dashboard.my-properties', compact('properties'));
            } else {
                return back();
            }
        } catch (\Throwable $th) {
            
            dd("Exception : " . $th->getMessage());
        }
    }
    
    public function favorite()
    {
        return view('pages.favorites');
    }
    public function favorite_render(Request $request)
    {
        $propertyId = $request->input('propertyId');
        
        $similars = Property::with('property_type')->whereIn('id', explode(',', $propertyId))
        ->where('status', 1)
        ->where('expire_status', 0)
        ->where('admin_status', 1)
        ->whereHas('property_agent', function ($query) {
            $query->where('status', 1);
            $query->where('approve_profile', 1);
        })
        ->orderBy('id', 'DESC')->get();
        
        $view = view('pages.generate-favorites', compact('similars'))->render();
        return response()->json(['html' => $view]);
    }
    public function add()
    {
        
        if (Auth::user()->status == 0) {
            return redirect()->route('profile')->with(['status' => trans('agent.You can not post a property because your profile is blocked')]);
        }
        
        if (Auth::user()->broker_office_id == '') {
            return redirect()->route('profile')->with(['status' => trans('agent.Please first add your office')]);
        }
        $cities = city::where('status', 1)->orderBy('position', 'ASC')->get();
        //        $outlooks=FeaturesCategory::where('status',1)->where("property_type_id",3)->orderBy('title','ASC')->get()->chunk(1);
        $locations = Location::where('status', 1)->orderBy('title', 'ASC')->get();
        $currencies = Currency::where('code', 'USD')
        ->orWhere('code', 'TRY')
        ->orWhere('code', 'EUR')
        ->orderBy('title', 'ASC')
        ->get()
        ->sortBy(function ($currency) {
            return array_search($currency->code, ['TRY', 'USD', 'EUR']);
        });
        
        
        return view('dashboard.add-property', compact('cities', 'locations', 'currencies'));
    }
    public function save(Request $request){
        try {

            $settings=settings::where('id',1)->first();
            $admin=User::where('id',env('ADMIN_ID'))->first();
            $user=Auth::user();
            if($user->broker_office_id == ''){
                return response()->json(['status' => 'false','icon'=>'info', 'message' => trans('admin.Please first select a broker office form your profile.')]);
            }
            $amount=0;
//            calculate the price to charge from agent
//            $amount=$settings->create_ad ?? 0;

            if($request->want_to_highlight == 'true'){
                $amount +=$settings->highlight_in_color;
            }
            $days=0;
            if($request->property_duration == 1){
                $amount +=($settings->credits_one_month);
                $days=30;

            }else if($request->property_duration == 2){

                $amount +=($settings->credits_two_month);
                $days=60;
            }
            else if($request->property_duration == 3){

//                $amount +=($settings->credits_three_month);
                $amount +=10;
                $days=90;
            }

            //extra images credits calculation.
            if ($request->hasFile('files')) {
                // Get the count of uploaded files
                $fileCount = count($request->file('files'));
                $extra_images = $fileCount - $settings->free_images;
                if ($extra_images > 0) {

                    $amount += $extra_images * $settings->credits_per_image;
                }
            }
            if($user->balance < $amount ){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Your available balance is less. please charge your account')]);
            }

            $rules = [
                'property_type' => ['required'],
                'property_town' => ['required'],
                'property_city' => ['required'],
                'property_district' => ['required'],
                'property_latitude' => ['required'],
                'property_longitude' => ['required'],
                'property_currency' => ['required'],
                'property_price' => ['required'],
                'files.*' => ['nullable', 'mimes:jpeg,bmp,png,gif,svg'],
            ];


            $customMessages = [];
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $index => $file) {
                    $customMessages["files.$index.mimes"] = "File item $index must be one of the allowed file types (jpeg, bmp, png, gif, svg).";
                }
            }

            $validator = Validator::make($request->all(), $rules, $customMessages);

            if ($validator->fails()) {
                $errors = $validator->errors()->first();
                return response()->json(['status' => 'false','icon'=>'error', 'message' => $errors]);
            }

            DB::beginTransaction();
            $currentDate = date('d-m-Y');
            $property=Property::create([

                'user_id' => Auth::user()->id,
                'property_type_id' => $request->property_type,
                'town_id' => $request->property_town,
                'city_id' => $request->property_city,
                'district_id' => $request->property_district,
                'latitude' => $request->property_latitude,
                'longitude' => $request->property_longitude,
                'outlook_ids' => $request->property_outlooks,
                'location_ids' => $request->property_locations_ids,
                'location_values' => $request->property_locations_values,
                'description' => $request->property_description,
                'currency_id' => $request->property_currency,
                'price' => makeCurrencyInt($request->property_price),

                'price_in_usd' => convertCurrency($request->property_price,$request->property_currency),

                'duration' => $request->property_duration,
                'highlight' => $request->want_to_highlight,
                'expire_date' => date('d-m-Y', strtotime($currentDate . ' +'.$days.' days')),
                'create_date' => date('d-m-Y'),

            ]);

            if($property){

//               charge the user and add the amount to admin balance

                //if login user is not admin then charge it
                if(Auth::user()->id != $admin->id){

                    $admin->balance +=$amount;
                    $admin->save();

                    $user->balance -=$amount;
                    $user->save();

//                add transactions history
                    Transaction::create([
                        'property_id'=>$property->id,
                        'user_id'=>$user->id,
                        'amount'=>$amount,
                        'status'=>'post property',
                        'currency_id'=>$request->property_currency,
                        'create_date' => date('d-m-Y'),
                    ]);
                    UseCredits::create([
                        'property_id'=>$property->id,
                        'user_id'=>$user->id,
                        'amount'=>$amount,
                        'status'=>'post property',
                        'currency_id'=>$request->property_currency,
                        'create_date' => date('d-m-Y'),
                    ]);
                }

                //compress add watermark and save property images
                if ($request->hasFile('files') ) {
                    $files = $request->file('files');
                    $preview_image=PropertyImage::saveImage($files,$property->id,true);
                    $property->preview_image=$preview_image;
                }

                // update the property slug
                $city=city::where('id',$request->property_city)->first();
                $slug="360TR-".$city->number."-".$request->property_type."-".$property->id;
                $property->slug=$slug;
                $property->save();

                //  save the property attributes
                if($request->property_type == 1){

                    $attribute=ApartmentAttribute::create([
                        'property_type_id'=>$request->property_type,
                        'property_id'=>$property->id,
                        'price'=>$request->property_price,
                        'type'=>$request->type,
                        'conditionp'=>$request->conditionp,
                        'grossm2'=>$request->grossm2,
                        'netm2'=>$request->netm2,
                        'bed_rooms'=>$request->bed_rooms,
                        'living_rooms'=>$request->living_rooms,
                        'bath_rooms'=>$request->bath_rooms,
                        'age'=>$request->age,
                        'status'=>$request->status,
                        'floors'=>$request->floors,
                        'building_floors'=>$request->building_floors,
                        'heating'=>$request->heating,
                        'elevator'=>$request->elevator,
                        'create_date'=>date('d-m-Y'),
                    ]);

                }elseif ($request->property_type == 2){

                    $attribute=VillaAttribute::create([
                        'property_type_id'=>$request->property_type,
                        'property_id'=>$property->id,
                        'price'=>$request->property_price,
                        'conditionp'=>$request->conditionp,
                        'grossm2'=>$request->grossm2,
                        'netm2'=>$request->netm2,
                        'landm2'=>$request->landm2,
                        'bed_rooms'=>$request->bed_rooms,
                        'living_rooms'=>$request->living_rooms,
                        'bath_rooms'=>$request->bath_rooms,
                        'age'=>$request->age,
                        'garden'=>$request->garden,
                        'floors'=>$request->floors,
                        'elevator'=>$request->elevator,
                        'create_date'=>date('d-m-Y'),
                    ]);

                }elseif ($request->property_type == 3){

                    $attribute=HouseAttribute::create([
                        'property_type_id'=>$request->property_type,
                        'property_id'=>$property->id,
                        'price'=>$request->property_price,
                        'conditionp'=>$request->conditionp,
                        'grossm2'=>$request->grossm2,
                        'netm2'=>$request->netm2,
                        'landm2'=>$request->landm2,
                        'bed_rooms'=>$request->bed_rooms,
                        'living_rooms'=>$request->living_rooms,
                        'bath_rooms'=>$request->bath_rooms,
                        'age'=>$request->age,
                        'garden'=>$request->garden,
                        'floors'=>$request->floors,
                        'create_date'=>date('d-m-Y'),
                    ]);

                }elseif ($request->property_type == 4){

                    $attribute=BuildingAttribute::create([
                        'property_type_id'=>$request->property_type,
                        'property_id'=>$property->id,
                        'price'=>$request->property_price,
                        'conditionp'=>$request->conditionp,
                        'grossm2'=>$request->grossm2,
                        'floors'=>$request->floors,
                        'flats'=>$request->flats,
                        'shops'=>$request->shops,
                        'storage_rooms'=>$request->storage_rooms,
                        'age'=>$request->age,
                        'elevator'=>$request->elevator,
                        'create_date'=>date('d-m-Y'),
                    ]);

                }elseif ($request->property_type == 5){

                    $attribute=LandAttribute::create([
                        'property_type_id'=>$request->property_type,
                        'property_id'=>$property->id,
                        'price'=>$request->property_price,
                        'landm2'=>$request->landm2,
                        'pricem2'=>0,
                        'status'=>$request->status,
                        'flats'=>$request->flats,
                        'type'=>$request->type,
                        'create_date'=>date('d-m-Y'),
                    ]);
                }

                $input_label = explode(",", $request->dynamic_labels);
                $input_type = explode(",", $request->dynamic_types);
                $placeholder = explode(",", $request->dynamic_placeholders);
                $values = explode(',',$request->dynamic_values);

                $dataToInsert = [];
                foreach ($input_label as $key => $label) {
                    $dataToInsert[] = [
                        'property_id' => $property->id,
                        'label' => $label,
                        'type' => $input_type[$key],
                        'placeholder' => $placeholder[$key],
                        'value' => $values[$key],
                    ];
                }
                filled_dynamic_form::insert($dataToInsert);

                //send notification
                $data=[
                    'name'=>$user->name,
                    'slug'=>$property->slug,
                    'subject'=>'Property Posted',
                    'message'=>"Your property is posted successfully, property number is ".$property->slug.".",
                ];
                DB::commit();
//                $user->notify(new PropertyNotification($data));
                return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.Property saved successfully')]);
            }else{
                DB::rollback();
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Failed to save property')]);
            }
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception to save property')]);
        }
    }
    
    protected function applyPropertyTypeFilters($query, $request, $type_id)
    {
        switch($type_id) {
            case 1:
                $query->whereHas('apartment_attribute', function($q) use ($request) {
                    if ($request->filled('apartment_type')) {
                        $q->whereIn('type', $request->apartment_type);
                    }
                    if ($request->filled('apartment_conditionp')) {
                        $q->whereIn('condition', $request->apartment_conditionp);
                    }
                    if ($request->filled(['min_apartment_grossm2', 'max_apartment_grossm2'])) {
                        $q->whereBetween('grossm2', [
                            str_replace('.', '', $request->min_apartment_grossm2),
                            str_replace('.', '', $request->max_apartment_grossm2)
                        ]);
                    }
                    if ($request->filled(['min_apartment_bed', 'max_apartment_bed'])) {
                        $q->whereBetween('bed_rooms', [$request->min_apartment_bed, $request->max_apartment_bed]);
                    }
                    if ($request->filled(['min_apartment_bath', 'max_apartment_bath'])) {
                        $q->whereBetween('bath_rooms', [$request->min_apartment_bath, $request->max_apartment_bath]);
                    }
                    if ($request->filled('apartment_elevator')) {
                        $q->where('elevator', $request->apartment_elevator);
                    }
                });
                break;
                
                case 2:
                    $query->whereHas('villa_attribute', function($q) use ($request) {
                        if ($request->filled('villa_conditionp')) {
                            $q->whereIn('condition', $request->villa_conditionp);
                        }
                        if ($request->filled(['min_villa_grossm2', 'max_villa_grossm2'])) {
                            $q->whereBetween('grossm2', [
                                str_replace('.', '', $request->min_villa_grossm2),
                                str_replace('.', '', $request->max_villa_grossm2)
                            ]);
                        }
                        if ($request->filled(['min_villa_landm2', 'max_villa_landm2'])) {
                            $q->whereBetween('landm2', [
                                str_replace('.', '', $request->min_villa_landm2),
                                str_replace('.', '', $request->max_villa_landm2)
                            ]);
                        }
                        // Add other villa filters...
                    });
                    break;
                    
                    case 3:
                        $query->whereHas('house_attribute', function($q) use ($request) {
                            if ($request->filled('house_conditionp')) {
                                $q->whereIn('condition', $request->house_conditionp);
                            }
                            if ($request->filled(['min_house_grossm2', 'max_house_grossm2'])) {
                                $q->whereBetween('grossm2', [
                                    str_replace('.', '', $request->min_house_grossm2),
                                    str_replace('.', '', $request->max_house_grossm2)
                                ]);
                            }
                            // Add other house filters...
                        });
                        break;
                        
                        case 4:
                            $query->whereHas('building_attribute', function($q) use ($request) {
                                if ($request->filled('building_conditionp')) {
                                    $q->whereIn('condition', $request->building_conditionp);
                                }
                                if ($request->filled(['min_building_grossm2', 'max_building_grossm2'])) {
                                    $q->whereBetween('grossm2', [
                                        str_replace('.', '', $request->min_building_grossm2),
                                        str_replace('.', '', $request->max_building_grossm2)
                                    ]);
                                }
                                // Add other building filters...
                            });
                            break;
                            
                            case 5:
                                $query->whereHas('land_attribute', function($q) use ($request) {
                                    if ($request->filled('land_type')) {
                                        $q->whereIn('type', $request->land_type);
                                    }
                                    if ($request->filled(['min_land_grossm2', 'max_land_grossm2'])) {
                                        $q->whereBetween('landm2', [
                                            str_replace('.', '', $request->min_land_grossm2),
                                            str_replace('.', '', $request->max_land_grossm2)
                                        ]);
                                    }
                                    // Add other land filters...
                                });
                                break;
                            }
                        }
                        public function edit($slug = '')
                        {
                            try {
                                $cities = city::where('status', 1)->orderBy('position', 'ASC')->get();
                                $locations = Location::where('status', 1)->orderBy('title', 'ASC')->get();
                                $currencies = Currency::where('code', 'USD')
                                ->orWhere('code', 'TRY')
                                ->orWhere('code', 'EUR')
                                ->orderBy('title', 'ASC')
                                ->get()
                                ->sortBy(function ($currency) {
                                    return array_search($currency->code, ['TRY', 'USD', 'EUR']);
                                });
                                
                                $property = Property::where('slug', $slug)->first();
                                $dynamic_data = filled_dynamic_form::where('property_id', $property->id)->get();
                                Notifications::create([
                                    'subject' => 'Property Update',
                                    'create_date' => Carbon::now(),
                                    'user_id' => Auth::user()->id,
                                    'message' => 'Your property listing has been updated.',
                                ]);
                                if (($property) && ($property->user_id == Auth::user()->id)) {
                                    return view('dashboard.edit-property', compact('property', 'dynamic_data', 'cities', 'locations', 'currencies'));
                                } else {
                                    return back();
                                }
                            } catch (\Throwable $th) {
                                
                                dd("Exception : " . $th->getMessage());
                            }
                        }
                        public function update(Request $request)
                        {
                            try {
                                
                                $property = Property::where('id', $request->id)->first();
                                if (!$property) {
                                    return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Property not found')]);
                                }
                                
                                $settings = settings::where('id', 1)->first();
                                $admin = User::where('id', env('ADMIN_ID'))->first();
                                $user = Auth::user();
                                
                                //            calculate the price to charge from agent
                                $amount = 0;
                                
                                if ($request->want_to_highlight == 'true' && $property->highlight == 'false') {
                                    $amount += $settings->highlight_in_color;
                                }
                                //            if(($request->property_duration > 1) && ($request->property_duration != $property->duration)){
                                //
                                //                $amount += ($request->property_duration * $settings->extention_one_month);
                                //
                                //            }
                                //extra images credits calculation.
                                if ($request->hasFile('files')) {
                                    
                                    $freeImages = $settings->free_images;
                                    
                                    $propertyImageCount = $property->property_images->count();
                                    $uploadImageCount =  count($request->file('files'));
                                    $totalImages = $propertyImageCount + $uploadImageCount;
                                    $extraImages = 0;
                                    
                                    if ($totalImages > $freeImages) {
                                        $freecount = 0;
                                        if ($propertyImageCount < $freeImages) {
                                            $freecount = $freeImages - $propertyImageCount;
                                        }
                                        $extraImages =  $totalImages - $propertyImageCount - $freecount;
                                    }
                                    
                                    if ($extraImages > 0) {
                                        
                                        $amount += $extraImages * $settings->credits_per_image;
                                    }
                                }
                                if ($user->balance < $amount) {
                                    return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Your available balance is less. please charge your account')]);
                                }
                                
                                $rules = [
                                    'property_type' => ['required'],
                                    'property_town' => ['required'],
                                    'property_city' => ['required'],
                                    'property_district' => ['required'],
                                    'property_latitude' => ['required'],
                                    'property_longitude' => ['required'],
                                    'property_currency' => ['required'],
                                    'property_price' => ['required'],
                                    'files.*' => ['nullable', 'mimes:jpeg,bmp,png,gif,svg'],
                                ];
                                
                                $customMessages = [];
                                if ($request->hasFile('files')) {
                                    foreach ($request->file('files') as $index => $file) {
                                        $customMessages["files.$index.mimes"] = "File item $index must be one of the allowed file types (jpeg, bmp, png, gif, svg).";
                                    }
                                }
                                
                                $validator = Validator::make($request->all(), $rules, $customMessages);
                                
                                if ($validator->fails()) {
                                    $errors = $validator->errors()->first();
                                    return response()->json(['status' => 'false', 'icon' => 'error', 'message' => $errors]);
                                }
                                
                                $property->property_type_id = $request->property_type;
                                $property->town_id = $request->property_town;
                                $property->city_id = $request->property_city;
                                $property->district_id = $request->property_district;
                                $property->latitude = $request->property_latitude;
                                $property->longitude = $request->property_longitude;
                                $property->outlook_ids = $request->property_outlooks;
                                $property->location_ids = $request->property_locations_ids;
                                $property->location_values = $request->property_locations_values;
                                $property->currency_id = $request->property_currency;
                                
                                $property->price = makeCurrencyInt($request->property_price);
                                
                                $property->price_in_usd = convertCurrency($request->property_price, $request->property_currency);
                                //            $property->duration =$request->property_duration;
                                $property->highlight = $request->want_to_highlight;
                                
                                //compress add watermark and save property images
                                if ($request->hasFile('files')) {
                                    $files = $request->file('files');
                                    PropertyImage::saveImage($files, $property->id, false);
                                }
                                
                                DB::beginTransaction();
                                //charge the user and add the amount to admin balance
                                if ($amount > 0 && (Auth::user()->id != $admin->id)) {
                                    
                                    $admin->balance += $amount;
                                    $admin->save();
                                    
                                    $user->balance -= $amount;
                                    $user->save();
                                    
                                    //add transactions history
                                    Transaction::create([
                                        'property_id' => $property->id,
                                        'user_id' => $user->id,
                                        'amount' => $amount,
                                        'status' => 'update property',
                                        'currency_id' => $request->property_currency,
                                        'create_date' => date('d-m-Y'),
                                    ]);
                                    UseCredits::create([
                                        'property_id' => $property->id,
                                        'user_id' => $user->id,
                                        'amount' => $amount,
                                        'status' => 'update property',
                                        'currency_id' => $request->property_currency,
                                        'create_date' => date('d-m-Y'),
                                    ]);
                                    Notifications::create([
                                        'subject' => 'Property Update',
                                        'create_date' => Carbon::now(),
                                        'user_id' => $user->id,
                                        'message' => 'Your property listing has been updated.',
                                    ]);
                                }
                                
                                // update the property slug
                                $city = city::where('id', $request->property_city)->first();
                                $slug = "360TR-" . $city->number . "-" . $request->property_type . "-" . $property->id;
                                $property->slug = $slug;
                                
                                //  save the property attributes
                                if ($request->property_type == 1) {
                                    
                                    //first delete
                                    if (ApartmentAttribute::where('property_id', $property->id)->exists()) {
                                        ApartmentAttribute::where('property_id', $property->id)->delete();
                                    }
                                    
                                    $attribute = ApartmentAttribute::create([
                                        'property_type_id' => $request->property_type,
                                        'property_id' => $property->id,
                                        'price' => $request->property_price,
                                        'conditionp' => $request->conditionp,
                                        'type' => $request->type,
                                        'grossm2' => $request->grossm2,
                                        'netm2' => $request->netm2,
                                        'bed_rooms' => $request->bed_rooms,
                                        'living_rooms' => $request->living_rooms,
                                        'bath_rooms' => $request->bath_rooms,
                                        'age' => $request->age,
                                        'status' => $request->status,
                                        'floors' => $request->floors,
                                        'building_floors' => $request->building_floors,
                                        'heating' => $request->heating,
                                        'elevator' => $request->elevator,
                                        'create_date' => date('d-m-Y'),
                                    ]);
                                } elseif ($request->property_type == 2) {
                                    
                                    //first delete
                                    if (VillaAttribute::where('property_id', $property->id)->exists()) {
                                        VillaAttribute::where('property_id', $property->id)->delete();
                                    }
                                    $attribute = VillaAttribute::create([
                                        'property_type_id' => $request->property_type,
                                        'property_id' => $property->id,
                                        'price' => $request->property_price,
                                        'conditionp' => $request->conditionp,
                                        'grossm2' => $request->grossm2,
                                        'netm2' => $request->netm2,
                                        'landm2' => $request->landm2,
                                        'bed_rooms' => $request->bed_rooms,
                                        'living_rooms' => $request->living_rooms,
                                        'bath_rooms' => $request->bath_rooms,
                                        'age' => $request->age,
                                        'garden' => $request->garden,
                                        'floors' => $request->floors,
                                        'elevator' => $request->elevator,
                                        'create_date' => date('d-m-Y'),
                                    ]);
                                } elseif ($request->property_type == 3) {
                                    
                                    //first delete
                                    if (HouseAttribute::where('property_id', $property->id)->exists()) {
                                        HouseAttribute::where('property_id', $property->id)->delete();
                                    }
                                    $attribute = HouseAttribute::create([
                                        'property_type_id' => $request->property_type,
                                        'property_id' => $property->id,
                                        'price' => $request->property_price,
                                        'conditionp' => $request->conditionp,
                                        'grossm2' => $request->grossm2,
                                        'netm2' => $request->netm2,
                                        'landm2' => $request->landm2,
                                        'bed_rooms' => $request->bed_rooms,
                                        'living_rooms' => $request->living_rooms,
                                        'bath_rooms' => $request->bath_rooms,
                                        'age' => $request->age,
                                        'garden' => $request->garden,
                                        'floors' => $request->floors,
                                        'create_date' => date('d-m-Y'),
                                    ]);
                                } elseif ($request->property_type == 4) {
                                    //first delete
                                    if (BuildingAttribute::where('property_id', $property->id)->exists()) {
                                        BuildingAttribute::where('property_id', $property->id)->delete();
                                    }
                                    $attribute = BuildingAttribute::create([
                                        'property_type_id' => $request->property_type,
                                        'property_id' => $property->id,
                                        'price' => $request->property_price,
                                        'conditionp' => $request->conditionp,
                                        'grossm2' => $request->grossm2,
                                        'floors' => $request->floors,
                                        'flats' => $request->flats,
                                        'shops' => $request->shops,
                                        'storage_rooms' => $request->storage_rooms,
                                        'age' => $request->age,
                                        'elevator' => $request->elevator,
                                        'create_date' => date('d-m-Y'),
                                    ]);
                                } elseif ($request->property_type == 5) {
                                    //first delete
                                    if (LandAttribute::where('property_id', $property->id)->exists()) {
                                        LandAttribute::where('property_id', $property->id)->delete();
                                    }
                                    $attribute = LandAttribute::create([
                                        'property_type_id' => $request->property_type,
                                        'property_id' => $property->id,
                                        'price' => $request->property_price,
                                        'landm2' => $request->landm2,
                                        'pricem2' => 0,
                                        'status' => $request->status,
                                        'flats' => $request->flats,
                                        'type' => $request->type,
                                        'create_date' => date('d-m-Y'),
                                    ]);
                                }
                                
                                
                                if ($property->save()) {
                                    filled_dynamic_form::where('property_id', $property->id)->delete();
                                    
                                    $input_label = explode(",", $request->dynamic_labels);
                                    $input_type = explode(",", $request->dynamic_types);
                                    $placeholder = explode(",", $request->dynamic_placeholders);
                                    $values = explode(',', $request->dynamic_values);
                                    
                                    $dataToInsert = [];
                                    foreach ($input_label as $key => $label) {
                                        $dataToInsert[] = [
                                            'property_id' => $property->id,
                                            'label' => $label,
                                            'type' => $input_type[$key],
                                            'placeholder' => $placeholder[$key],
                                            'value' => $values[$key],
                                        ];
                                    }
                                    filled_dynamic_form::insert($dataToInsert);
                                    
                                    DB::commit();
                                    Notifications::create([
                                        'subject' => 'Property Update',
                                        'create_date' => Carbon::now(),
                                        'user_id' => $user->id,
                                        'message' => 'Your property listing has been updated.',
                                    ]);
                                    return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Property updated successfully')]);
                                } else {
                                    DB::rollback();
                                    return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Failed to update property')]);
                                }
                            } catch (\Throwable $th) {
                                DB::rollback();
                                
                                //            return response()->json(['status' => 'false','icon'=>'error', 'message' => $th->getMessage()]);
                                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception to update property')]);
                            }
                        }
                        public function delete(Request $request)
                        {
                            try {
                                $id = $request->id;
                                DB::beginTransaction();
                                $product = Property::findorfail($id);
                                Notifications::create([
                                    'subject' => 'Property Update',
                                    'create_date' => Carbon::now(),
                                    'user_id' => $user->id,
                                    'message' => 'Your property listing has delete.',
                                ]);
                                if (!$product->delete()) {
                                    return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Failed to delete Property')]);
                                }
                                DB::commit();
                                return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Property deleted successfully')]);
                            } catch (\Throwable $th) {
                                DB::rollBack();
                                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception to delete Property')]);
                            }
                        }
                        public function deleteImage(Request $request)
                        {
                            try {
                                $id = $request->id;
                                DB::beginTransaction();
                                
                                $product = PropertyImage::findorfail($id);
                                
                                if (!$product->delete()) {
                                    return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Failed to delete Image')]);
                                }
                                if ($request->preview_image) {
                                    $property = Property::findorfail($request->property_id);
                                    $property->preview_image = '';
                                    $property->save();
                                }
                                
                                DB::commit();
                                return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Image deleted successfully')]);
                            } catch (\Throwable $th) {
                                DB::rollBack();
                                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => $th->getMessage()]);
                                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception to delete Image')]);
                            }
                        }
                        public function PreviewImage(Request $request)
                        {
                            try {
                                $id = $request->id;
                                DB::beginTransaction();
                                $property = Property::where('id', $request->property_id)->first();
                                $product = PropertyImage::findorfail($id);
                                $property->preview_image = $product->image_path;
                                if (!$property->save()) {
                                    return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Failed to mark this image as preview')]);
                                }
                                DB::commit();
                                return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Image marked as preview successfully')]);
                            } catch (\Throwable $th) {
                                DB::rollBack();
                                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception to mark this image as preview')]);
                            }
                        }
                        public function renew_property(Request $request)
                        {
                            try {
                                
                                $settings = settings::where('id', 1)->first();
                                $admin = User::where('id', env('ADMIN_ID'))->first();
                                
                                $id = $request->id;
                                
                                $amount = 0;
                                $days = 0;
                                
                                if ($request->property_duration == 1) {
                                    $amount = ($settings->credits_one_month);
                                    $days = 30;
                                } else if ($request->property_duration == 2) {
                                    
                                    $amount = ($settings->credits_two_month);
                                    $days = 60;
                                } else if ($request->property_duration == 3) {
                                    
                                    $amount = ($settings->credits_three_month);
                                    $days = 90;
                                }
                                $currentDate = date('d-m-Y');
                                $property = Property::findorfail($id);
                                
                                DB::beginTransaction();
                                $property->duration = $request->property_duration;
                                $property->expire_status = 0;
                                $property->expire_date = date('d-m-Y', strtotime($currentDate . ' +' . $days . ' days'));
                                
                                //calculate the price to charge from agent
                                $user = User::where('id', $property->user_id)->first();
                                
                                if (!$user) {
                                    return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Your available balance is less. please charge your account')]);
                                }
                                if ($user->id != $admin->id) {
                                    
                                    if ($user->balance < $amount) {
                                        return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Your available balance is less. please charge your account')]);
                                    }
                                    
                                    $admin->balance += $amount;
                                    $admin->save();
                                    
                                    $user->balance -= $amount;
                                    $user->save();
                                    
                                    //                add transactions history
                                    Transaction::create([
                                        'property_id' => $property->id,
                                        'user_id' => $user->id,
                                        'amount' => $amount,
                                        'status' => 'renew property',
                                        'currency_id' => $request->property_currency,
                                        'create_date' => date('d-m-Y'),
                                    ]);
                                    UseCredits::create([
                                        'property_id' => $property->id,
                                        'user_id' => $user->id,
                                        'amount' => $amount,
                                        'status' => 'renew property',
                                        'currency_id' => $request->property_currency,
                                        'create_date' => date('d-m-Y'),
                                    ]);
                                    Notifications::create([
                                        'subject' => 'Property Update',
                                        'create_date' => Carbon::now(),
                                        'user_id' => $user->id,
                                        'message' => 'Your property listing has renew.',
                                    ]);
                                }
                                
                                if (!$property->update()) {
                                    return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Failed to renew property')]);
                                }
                                DB::commit();
                                return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Property renewed successfully')]);
                            } catch (\Throwable $th) {
                                DB::rollBack();
                                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception to renew property')]);
                            }
                        }
                        public function update_status(Request $request)
                        {
                            try {
                                $id = $request->id;
                                DB::beginTransaction();
                                $user = Property::findorfail($id);
                                $user->status = $request->status;
                                
                                if (!$user->update()) {
                                    return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Failed to update Property status')]);
                                }
                                DB::commit();
                                Notifications::create([
                                    'subject' => 'Property Update',
                                    'create_date' => Carbon::now(),
                                    'user_id' => $user->id,
                                    'message' => 'Your property listing has updated.',
                                ]);
                                return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Property status updated successfully')]);
                            } catch (\Throwable $th) {
                                DB::rollBack();
                                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception to update Property status')]);
                            }
                        }
                        
                        public function testWatermark()
                        {
                            // Get the full path of the uploaded image
                            $picturePath = public_path('uploads/properties/testing.png');
                            
                            // Determine the file type
                            $imageInfo = getimagesize($picturePath);
                            $fileType = $imageInfo[2]; // The second element of getimagesize() result contains the image type
                            
                            // Open the image using GD
                            if ($fileType === IMAGETYPE_JPEG) {
                                $image = imagecreatefromjpeg($picturePath);
                            } elseif ($fileType === IMAGETYPE_PNG) {
                                $image = imagecreatefrompng($picturePath);
                            } else {
                                // Unsupported image type, handle accordingly (e.g., log an error, skip processing, etc.)
                            }
                            
                            // Add watermark text
                            $watermarkText = 'TREMLAK360.COM';
                            $textColor = imagecolorallocatealpha($image, 255, 255, 255, 90); // light gray with transparency
                            $font = public_path('check.ttf'); // Path to the font file
                            $fontSize = 20;
                            
                            // Calculate text dimensions
                            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $watermarkText);
                            $textWidth = abs($textBoundingBox[4] - $textBoundingBox[0]);
                            $textHeight = abs($textBoundingBox[5] - $textBoundingBox[1]);
                            
                            // Calculate text position
                            $imageWidth = imagesx($image);
                            $imageHeight = imagesy($image);
                            $x = (($imageWidth - $textWidth) / 2) + 50;
                            $y = (($imageHeight - $textHeight) / 2) + 80;
                            
                            // Rotate the text by 45 degrees
                            $angle = 45;
                            
                            // Add the watermark text to the image
                            imagettftext($image, $fontSize, $angle, $x, $y, $textColor, $font, $watermarkText);
                            
                            // Save the modified image
                            if ($fileType === IMAGETYPE_JPEG) {
                                imagejpeg($image, $picturePath);
                            } elseif ($fileType === IMAGETYPE_PNG) {
                                imagepng($image, $picturePath);
                            }
                            
                            // Free up memory
                            imagedestroy($image);
                            
                            // Serve the modified image
                            return response()->file($picturePath);
                        }
                        
                        public function properties(Request $request)
                        {
                            // Start with all properties
                            $properties = Property::query();
                            
                            // Filter by property type
                            if ($request->has('type_id_index') && $request->type_id_index != '') {
                                $properties->where('property_type_id', $request->type_id_index);
                            }
                            
                            // Filter by city
                            if ($request->has('city_id') && $request->city_id != '') {
                                $properties->where('city_id', $request->city_id);
                            }
                            
                            // Filter by price range
                            if ($request->has('min_price') && $request->min_price != '') {
                                $properties->where('price', '>=', $request->min_price);
                            }
                            
                            if ($request->has('max_price') && $request->max_price != '') {
                                $properties->where('price', '<=', $request->max_price);
                                dd($properties);
                            }
                            
                            // Get the filtered properties
                            $properties = $properties->get();
                            // Pass the filtered properties to the view
                            return view('pages.listing', compact('properties'));
                        }
                        
                        public function search(Request $request)
                        {
                            // Redirect to the properties page with the search criteria
                            return redirect()->route('properties')->withInput();
                        }
                        
                    }
