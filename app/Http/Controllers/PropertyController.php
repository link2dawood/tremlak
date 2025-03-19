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
use App\Models\VillaAttribute;
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

    //user side
    public function index(Request $request, $agent_id = '')
    {
        $propertyType = propertyType::where('status', 1)->orderBy('title', 'ASC')->get();
        $outlooks = FeaturesCategory::where('status', 1)->orderBy('title', 'ASC')->get();
        $locations = Location::where('status', 1)->orderBy('title', 'ASC')->get();

        try {
            $search_text_search = "";
            $town_id_search = "";
            $city_id_search = $request->city_id;
            $district_id_search = "";
            $type_id_search = $request->type_id_index;
            $agent_id_search = "";
            $outlooks_ids_search = "";
            $location_ids_with_values_search = array();
            $sort_by_search = 0;
            $search_min_price = $request->min_price;
            $search_max_price = $request->max_price;
            $agent = null;
            $bed_search = '';
            $bath_search = '';
            $apartment_type = '';
            $apartment_conditionp = '';
            $apartment_age = '';
            $apartment_heating = '';
            $villa_conditionp = '';
            $villa_age = '';
            $house_conditionp = '';
            $house_age = '';
            $building_conditionp = '';
            $building_age = '';
            $land_type = '';
            $land_status = '';
            $apartment_elevator = '';
            $villa_elevator = '';
            $villa_garden = '';
            $house_garden = '';
            $building_elevator = '';

            $min_apartment_grossm2 = 1;
            $max_apartment_grossm2 = "1.000";
            $min_apartment_bed = 0;
            $max_apartment_bed = 15;
            $min_apartment_bath = 0;
            $max_apartment_bath = 5;
            $min_apartment_living = 0;
            $max_apartment_living = 5;
            $min_apartment_floors = 0;
            $max_apartment_floors = 70;
            $min_apartment_building_floors = 0;
            $max_apartment_building_floors = 70;
            $min_villa_grossm2 = 1;
            $max_villa_grossm2 = "2.500";
            $min_villa_landm2 = 1;
            $max_villa_landm2 = "25.000";
            $min_villa_bed = 0;
            $max_villa_bed = 20;
            $min_villa_bath = 0;
            $max_villa_bath = 10;
            $min_villa_living = 0;
            $max_villa_living = 10;
            $min_villa_floors = 1;
            $max_villa_floors = 10;
            $min_house_grossm2 = 1;
            $max_house_grossm2 = "2.500";
            $min_house_landm2 = 1;
            $max_house_landm2 = "50.000";
            $min_house_bed = 0;
            $max_house_bed = 20;
            $min_house_bath = 0;
            $max_house_bath = 10;
            $min_house_living = 0;
            $max_house_living = 10;
            $min_house_floors = 1;
            $max_house_floors = 10;
            $min_building_grossm2 = 1;
            $max_building_grossm2 = "10.000";
            $min_building_floors = 1;
            $max_building_floors = 70;
            $min_building_flats = 0;
            $max_building_flats = 250;
            $min_building_shops = 0;
            $max_building_shops = 50;
            $min_land_grossm2 = 1;
            $max_land_grossm2 = "100.000";


            if (count($request->all()) == 0 && $agent_id == '') {

                $properties = Property::with('property_type')
                ->with('property_agent')
                ->with('property_town')
                ->with('property_city')
                ->with('property_district')
                ->with('property_images')
                ->with('property_details')
                ->where('status', 1)
                ->where('expire_status', 0)
                ->where('admin_status', 1)
                ->whereHas('property_agent', function ($query) {
                    $query->where('status', 1);
                    $query->where('approve_profile', 1);
                })
                ->orderBy('id', 'DESC')
                ->paginate(20)
                ->appends($request->except('page'));

                return view('pages.listing', compact(
                    'town_id_search','city_id_search','district_id_search','type_id_search','agent_id_search','outlooks_ids_search','location_ids_with_values_search','search_text_search','sort_by_search','search_min_price','search_max_price','properties','propertyType','outlooks','locations','agent','apartment_type','apartment_conditionp','apartment_age','apartment_heating','villa_conditionp','villa_age','house_conditionp','house_age','building_conditionp','building_age','land_type','land_status','apartment_elevator','villa_elevator','villa_garden','house_garden','building_elevator','min_apartment_grossm2','max_apartment_grossm2','min_apartment_bed','max_apartment_bed','min_apartment_bath','max_apartment_bath','min_apartment_living','max_apartment_living','min_apartment_floors','max_apartment_floors','min_apartment_building_floors','max_apartment_building_floors','min_villa_grossm2','max_villa_grossm2','min_villa_landm2','max_villa_landm2','min_villa_bed','max_villa_bed','min_villa_bath','max_villa_bath','min_villa_living','max_villa_living','min_villa_floors','max_villa_floors','min_house_grossm2','max_house_grossm2','min_house_landm2','max_house_landm2','min_house_bed','max_house_bed','min_house_bath','max_house_bath','min_house_living','max_house_living','min_house_floors','max_house_floors','min_building_grossm2','max_building_grossm2','min_building_floors','max_building_floors','min_building_flats','max_building_flats','min_building_shops','max_building_shops','min_land_grossm2','max_land_grossm2',
                ));
            } else {

                $query = Property::query();
                if ($request->has('type_id') && $request->input('type_id') == 1) {
                    if ($request->has('apartment_type') && $request->input('apartment_type') != "") {
                        $apartment_type = $request->input('apartment_type');
                        $query->whereHas('apartment_attribute', function ($q) use ($apartment_type) {
                            $q->whereIn('type', $apartment_type);
                        });
                    }
                    if ($request->has('apartment_conditionp') && $request->input('apartment_conditionp') != "") {
                        $apartment_conditionp = $request->input('apartment_conditionp');
                        $query->whereHas('apartment_attribute', function ($q) use ($apartment_conditionp) {
                            $q->whereIn('conditionp', $apartment_conditionp);
                        });
                    }

                    $min_apartment_grossm2 = $request->input('min_apartment_grossm2');
                    $max_apartment_grossm2 = $request->input('max_apartment_grossm2');
                    $query->whereHas('apartment_attribute', function ($q) use ($min_apartment_grossm2, $max_apartment_grossm2) {
                        $q->where('grossm2', '>=', intval(str_replace('.', '', $min_apartment_grossm2)))->where('grossm2', '<=', intval(str_replace('.', '', $max_apartment_grossm2)));
                    });

                    $min_apartment_bed = $request->input('min_apartment_bed');
                    $max_apartment_bed = $request->input('max_apartment_bed');
                    $query->whereHas('apartment_attribute', function ($q) use ($min_apartment_bed, $max_apartment_bed) {
                        $q->where('bed_rooms', '>=', intval($min_apartment_bed))->where('bed_rooms', '<=', intval($max_apartment_bed));
                    });

                    $min_apartment_bath = $request->input('min_apartment_bath');
                    $max_apartment_bath = $request->input('max_apartment_bath');
                    $query->whereHas('apartment_attribute', function ($q) use ($min_apartment_bath, $max_apartment_bath) {
                        $q->where('bath_rooms', '>=', intval($min_apartment_bath))->where('bath_rooms', '<=', intval($max_apartment_bath));
                    });

                    $min_apartment_living = $request->input('min_apartment_living');
                    $max_apartment_living = $request->input('max_apartment_living');
                    $query->whereHas('apartment_attribute', function ($q) use ($min_apartment_living, $max_apartment_living) {
                        $q->where('living_rooms', '>=', intval($min_apartment_living))->where('living_rooms', '<=', intval($max_apartment_living));
                    });

                    $min_apartment_floors = $request->input('min_apartment_floors');
                    if ($min_apartment_floors == '') {

                        $min_apartment_floors = 0;
                    }
                    $max_apartment_floors = $request->input('max_apartment_floors');
                    $query->whereHas('apartment_attribute', function ($q) use ($min_apartment_floors, $max_apartment_floors) {
                        $q->where('floors', '>=', intval($min_apartment_floors))->where('floors', '<=', intval($max_apartment_floors));
                    });

                    $min_apartment_building_floors = $request->input('min_apartment_building_floors');
                    $max_apartment_building_floors = $request->input('max_apartment_building_floors');
                    $query->whereHas('apartment_attribute', function ($q) use ($min_apartment_building_floors, $max_apartment_building_floors) {
                        $q->where('building_floors', '>=', intval($min_apartment_building_floors))->where('building_floors', '<=', intval($max_apartment_building_floors));
                    });

                    $min_apartment_building_floors = $request->input('min_apartment_building_floors');
                    $max_apartment_building_floors = $request->input('max_apartment_building_floors');
                    $query->whereHas('apartment_attribute', function ($q) use ($min_apartment_building_floors, $max_apartment_building_floors) {
                        $q->where('building_floors', '>=', intval($min_apartment_building_floors))->where('building_floors', '<=', intval($max_apartment_building_floors));
                    });

                    if ($request->has('apartment_age') && $request->input('apartment_age') != "") {
                        $apartment_age = $request->input('apartment_age');
                        $query->whereHas('apartment_attribute', function ($q) use ($apartment_age) {
                            $q->whereIn('age', $apartment_age);
                        });
                    }

                    if ($request->has('apartment_heating') && $request->input('apartment_heating') != "") {
                        $apartment_heating = $request->input('apartment_heating');
                        $query->whereHas('apartment_attribute', function ($q) use ($apartment_heating) {
                            $q->whereIn('heating', $apartment_heating);
                        });
                    }
                    if ($request->has('apartment_elevator') && $request->input('apartment_elevator') != "") {
                        $apartment_elevator = $request->input('apartment_elevator');
                        $query->whereHas('apartment_attribute', function ($q) use ($apartment_elevator) {
                            $q->where('elevator', $apartment_elevator);
                        });
                    }
                } else if ($request->has('type_id') && $request->input('type_id') == 2) {

                    if ($request->has('villa_conditionp') && $request->input('villa_conditionp') != "") {
                        $villa_conditionp = $request->input('villa_conditionp');
                        $query->whereHas('villa_attribute', function ($q) use ($villa_conditionp) {
                            $q->whereIn('conditionp', $villa_conditionp);
                        });
                    }

                    $min_villa_grossm2 = $request->input('min_villa_grossm2');
                    $max_villa_grossm2 = $request->input('max_villa_grossm2');
                    $query->whereHas('villa_attribute', function ($q) use ($min_villa_grossm2, $max_villa_grossm2) {
                        $q->where('grossm2', '>=', intval(str_replace('.', '', $min_villa_grossm2)))->where('grossm2', '<=', intval(str_replace('.', '', $max_villa_grossm2)));
                    });

                    $min_villa_landm2 = $request->input('min_villa_landm2');
                    $max_villa_landm2 = $request->input('max_villa_landm2');
                    $query->whereHas('villa_attribute', function ($q) use ($min_villa_landm2, $max_villa_landm2) {
                        $q->where('landm2', '>=', intval(str_replace('.', '', $min_villa_landm2)))->where('landm2', '<=', intval(str_replace('.', '', $max_villa_landm2)));
                    });

                    $min_villa_bed = $request->input('min_villa_bed');
                    $max_villa_bed = $request->input('max_villa_bed');
                    $query->whereHas('villa_attribute', function ($q) use ($min_villa_bed, $max_villa_bed) {
                        $q->where('bed_rooms', '>=', intval($min_villa_bed))->where('bed_rooms', '<=', intval($max_villa_bed));
                    });

                    $min_villa_bath = $request->input('min_villa_bath');
                    $max_villa_bath = $request->input('max_villa_bath');
                    $query->whereHas('villa_attribute', function ($q) use ($min_villa_bath, $max_villa_bath) {
                        $q->where('bath_rooms', '>=', intval($min_villa_bath))->where('bath_rooms', '<=', intval($max_villa_bath));
                    });

                    $min_villa_living = $request->input('min_villa_living');
                    $max_villa_living = $request->input('max_villa_living');
                    $query->whereHas('villa_attribute', function ($q) use ($min_villa_living, $max_villa_living) {
                        $q->where('living_rooms', '>=', intval($min_villa_living))->where('living_rooms', '<=', intval($max_villa_living));
                    });

                    $min_villa_floors = $request->input('min_villa_floors');
                    $max_villa_floors = $request->input('max_villa_floors');
                    $query->whereHas('villa_attribute', function ($q) use ($min_villa_floors, $max_villa_floors) {
                        $q->where('floors', '>=', intval($min_villa_floors))->where('floors', '<=', intval($max_villa_floors));
                    });

                    if ($request->has('villa_age') && $request->input('villa_age') != "") {
                        $villa_age = $request->input('villa_age');
                        $query->whereHas('villa_attribute', function ($q) use ($villa_age) {
                            $q->whereIn('age', $villa_age);
                        });
                    }
                    if ($request->has('villa_garden') && $request->input('villa_garden') != "") {
                        $villa_garden = $request->input('villa_garden');
                        $query->whereHas('villa_attribute', function ($q) use ($villa_garden) {
                            $q->where('garden', $villa_garden);
                        });
                    }
                    if ($request->has('villa_elevator') && $request->input('villa_elevator') != "") {
                        $villa_elevator = $request->input('villa_elevator');
                        $query->whereHas('villa_attribute', function ($q) use ($villa_elevator) {
                            $q->where('elevator', $villa_elevator);
                        });
                    }
                } else if ($request->has('type_id') && $request->input('type_id') == 3) {

                    if ($request->has('house_conditionp') && $request->input('house_conditionp') != "") {
                        $house_conditionp = $request->input('house_conditionp');
                        $query->whereHas('house_attribute', function ($q) use ($house_conditionp) {
                            $q->whereIn('conditionp', $house_conditionp);
                        });
                    }

                    $min_house_grossm2 = $request->input('min_house_grossm2');
                    $max_house_grossm2 = $request->input('max_house_grossm2');
                    $query->whereHas('house_attribute', function ($q) use ($min_house_grossm2, $max_house_grossm2) {
                        $q->where('grossm2', '>=', intval(str_replace('.', '', $min_house_grossm2)))->where('grossm2', '<=', intval(str_replace('.', '', $max_house_grossm2)));
                    });

                    $min_house_landm2 = $request->input('min_house_landm2');
                    $max_house_landm2 = $request->input('max_house_landm2');
                    $query->whereHas('house_attribute', function ($q) use ($min_house_landm2, $max_house_landm2) {
                        $q->where('landm2', '>=', intval(str_replace('.', '', $min_house_landm2)))->where('landm2', '<=', intval(str_replace('.', '', $max_house_landm2)));
                    });

                    $min_house_bed = $request->input('min_house_bed');
                    $max_house_bed = $request->input('max_house_bed');
                    $query->whereHas('house_attribute', function ($q) use ($min_house_bed, $max_house_bed) {
                        $q->where('bed_rooms', '>=', intval($min_house_bed))->where('bed_rooms', '<=', intval($max_house_bed));
                    });

                    $min_house_bath = $request->input('min_house_bath');
                    $max_house_bath = $request->input('max_house_bath');
                    $query->whereHas('house_attribute', function ($q) use ($min_house_bath, $max_house_bath) {
                        $q->where('bath_rooms', '>=', intval($min_house_bath))->where('bath_rooms', '<=', intval($max_house_bath));
                    });

                    $min_house_living = $request->input('min_house_living');
                    $max_house_living = $request->input('max_house_living');
                    $query->whereHas('house_attribute', function ($q) use ($min_house_living, $max_house_living) {
                        $q->where('living_rooms', '>=', intval($min_house_living))->where('living_rooms', '<=', intval($max_house_living));
                    });

                    $min_house_floors = $request->input('min_house_floors');
                    $max_house_floors = $request->input('max_house_floors');
                    $query->whereHas('house_attribute', function ($q) use ($min_house_floors, $max_house_floors) {
                        $q->where('floors', '>=', intval($min_house_floors))->where('floors', '<=', intval($max_house_floors));
                    });

                    if ($request->has('house_age') && $request->input('house_age') != "") {
                        $house_age = $request->input('house_age');
                        $query->whereHas('house_attribute', function ($q) use ($house_age) {
                            $q->whereIn('age', $house_age);
                        });
                    }
                    if ($request->has('house_garden') && $request->input('house_garden') != "") {
                        $house_garden = $request->input('house_garden');
                        $query->whereHas('house_attribute', function ($q) use ($house_garden) {
                            $q->where('garden', $house_garden);
                        });
                    }
                } else if ($request->has('type_id') && $request->input('type_id') == 4) {

                    if ($request->has('building_conditionp') && $request->input('building_conditionp') != "") {
                        $building_conditionp = $request->input('building_conditionp');
                        $query->whereHas('building_attribute', function ($q) use ($building_conditionp) {
                            $q->whereIn('conditionp', $building_conditionp);
                        });
                    }

                    // $min_building_grossm2 = $request->input('min_building_grossm2');
                    // $max_building_grossm2 = $request->input('max_building_grossm2');
                    $min_building_grossm2 = intval(str_replace('.', '', $request->input('min_building_grossm2', 0)));
                    $max_building_grossm2 = intval(str_replace('.', '', $request->input('max_building_grossm2', PHP_INT_MAX)));

                    $query->whereHas('building_attribute', function ($q) use ($min_building_grossm2, $max_building_grossm2) {
                        $q->where('grossm2', '>=', intval(str_replace('.', '', $min_building_grossm2)))->where('grossm2', '<=', intval(str_replace('.', '', $max_building_grossm2)));
                    });

                    $min_building_flats = $request->input('min_building_flats');
                    $max_building_flats = $request->input('max_building_flats');
                    $query->whereHas('building_attribute', function ($q) use ($min_building_flats, $max_building_flats) {
                        $q->where('flats', '>=', intval($min_building_flats))->where('flats', '<=', intval($max_building_flats));
                    });

                    $min_building_shops = $request->input('min_building_shops');
                    $max_building_shops = $request->input('max_building_shops');
                    $query->whereHas('building_attribute', function ($q) use ($min_building_shops, $max_building_shops) {
                        $q->where('shops', '>=', intval($min_building_shops))->where('shops', '<=', intval($max_building_shops));
                    });

                    $min_building_floors = $request->input('min_building_floors');
                    $max_building_floors = $request->input('max_building_floors');
                    $query->whereHas('building_attribute', function ($q) use ($min_building_floors, $max_building_floors) {
                        $q->where('floors', '>=', intval($min_building_floors))->where('floors', '<=', intval($max_building_floors));
                    });

                    if ($request->has('building_age') && $request->input('building_age') != "") {
                        $building_age = $request->input('building_age');
                        $query->whereHas('building_attribute', function ($q) use ($building_age) {
                            $q->whereIn('age', $building_age);
                        });
                    }
                    if ($request->has('building_elevator') && $request->input('building_elevator') != "") {
                        $building_elevator = $request->input('building_elevator');
                        $query->whereHas('building_attribute', function ($q) use ($building_elevator) {
                            $q->where('elevator', $building_elevator);
                        });
                    }
                } else if ($request->has('type_id') && $request->input('type_id') == 5) {

                    if ($request->has('land_type') && $request->input('land_type') != "") {
                        $land_type = $request->input('land_type');
                        $query->whereHas('land_attribute', function ($q) use ($land_type) {
                            $q->whereIn('type', $land_type);
                        });
                    }

                    if ($request->has('land_status') && $request->input('land_status') != "") {
                        $land_status = $request->input('land_status');
                        $query->whereHas('land_attribute', function ($q) use ($land_status) {
                            $q->whereIn('status', $land_status);
                        });
                    }

                    $min_land_grossm2 = $request->input('min_land_grossm2');
                    $max_land_grossm2 = $request->input('max_land_grossm2');
                    $query->whereHas('land_attribute', function ($q) use ($min_land_grossm2, $max_land_grossm2) {

                        $q->where('landm2', '>=', intval(str_replace('.', '', $min_land_grossm2)))->where('landm2', '<=', intval(str_replace('.', '', $max_land_grossm2)));
                    });

                    //                    $min_land_pricem2 = $request->input('min_land_pricem2');
                    //                    $max_land_pricem2 = $request->input('max_land_pricem2');
                    //                    $query->whereHas('land_attribute', function ($q) use ($min_land_pricem2, $max_land_pricem2) {
                    //                        $q->where('pricem2', '>=', intval($min_land_pricem2))->where('pricem2', '<=', intval($max_land_pricem2));
                    //                    });

                }

                $query = Property::query();
                if ($request->has('type_id_index') && $request->input('type_id_index') != "") {
                    $type_id_search = (int) $request->input('type_id_index');

                    $query->where('property_type_id', $type_id_search);
                }

                if ($request->has('type_id') && $request->input('type_id') != "") {

                    $type_id_search = (int) $request->input('type_id');

                    $query->where('property_type_id', $type_id_search);
                }

                if ($request->has('city_id') && $request->input('city_id') != "") {

                    $city_id_search =  (int) $request->input('city_id');
                    $query->where('city_id', $city_id_search);
                }

                if ($request->has('town_id') && $request->input('town_id') != "") {

                    $town_id_search = (int) $request->input('town_id');
                    $query->where('town_id', $town_id_search);
                    // dd($town_id_search);
                }

                if ($request->has('district_id') && $request->input('district_id') != "") {

                    $district_id_search = (int) $request->input('district_id');
                    $query->where('district_id', $district_id_search);
                }

                if ($agent_id != "") {

                    $agent = User::where('id', $agent_id)->where('status', 1)->where('approve_profile', 1)->first();

                    if (!$agent) {
                        return back();
                    }
                    $agent_id_search = $agent_id;
                    $query->where('user_id', $agent_id_search);
                }

                if ($request->has('outlooks_ids') && $request->input('outlooks_ids') != "") {

                    $outlooks_ids_search =  $request->input('outlooks_ids');
                    $query->where(function ($query) use ($outlooks_ids_search) {
                        foreach ($outlooks_ids_search as $outlook_id) {
                            $query->orWhereRaw("FIND_IN_SET(?, outlook_ids)", [$outlook_id]);
                        }
                    });
                }

                // search by nearby locations
                if ($request->has('location_ids_with_values') && $request->input('location_ids_with_values') != "") {

                    $location_ids_with_values_search2 =  $request->input('location_ids_with_values');

                    $ids = array();
                    $values = array();

                    foreach ($location_ids_with_values_search2 as $location_ids_values) {

                        $temp = explode('-', $location_ids_values);
                        if (count($temp) > 1) {

                            $ids[] = $temp[0];
                            $location_ids_with_values_search[] = $location_ids_values;
                            $values[] = $temp[1];
                        }
                    }

                    $query->where(function ($query) use ($ids) {
                        foreach ($ids as $id) {
                            $query->whereRaw("FIND_IN_SET(?, location_ids)", [$id]);
                        }
                    });

                    $query->where(function ($query) use ($values) {
                        foreach ($values as $value) {
                            $query->whereRaw("FIND_IN_SET(?, location_values)", [$value]);
                        }
                    });
                }

                // search by price
                // search by price
                if ($request->has('min_price') && $request->has('max_price')) {
                    // Remove currency symbol and commas from min_price and max_price
                    $min_price_cleaned = str_replace(['₺', ','], '', $request->input('min_price'));
                    $max_price_cleaned = str_replace(['₺', ','], '', $request->input('max_price'));
                    // Convert cleaned prices to integers
                    $search_min_price = intval($min_price_cleaned);
                    $search_max_price = intval($max_price_cleaned);

                    // Use the cleaned prices in the query
                    $query->where('price_in_usd', '>=', $search_min_price)
                    ->where('price_in_usd', '<=', $search_max_price);
                }

                // search by title
                if ($request->has('search_text') && $request->input('search_text') != "") {
                    $search_text_search = $request->input('search_text');

                    $query->where(function ($query) use ($search_text_search) {
                        $query->where('title', 'LIKE', '%' . $search_text_search . '%');
                    });
                }

                //sorting
                if ($request->has('sort_by') && $request->input('sort_by') != "") {

                    $sort_by_search = $request->input('sort_by');

                    //0=newest,1=oldest,2 low price,3 height price
                    if ($sort_by_search == 0) {

                        $query->orderBy('id', 'DESC');
                    } elseif ($sort_by_search == 1) {

                        $query->orderBy('id', 'ASC');
                    } elseif ($sort_by_search == 2) {

                        $query->orderBy('price_in_usd', 'ASC');
                    } elseif ($sort_by_search == 3) {

                        $query->orderBy('price_in_usd', 'DESC');
                    }
                } //sorting


                $type_id_index = $request->input('type_id_index');

                $city_id = $request->input('city_id');
                $min_price = $request->input('min_price');
                $max_price = $request->input('max_price');
                $properties = $query->with('property_type')
                ->with('property_agent')
                ->with('property_town')
                ->with('property_city')
                ->with('property_district')
                ->with('property_images')
                ->with('property_details')
                ->where('status', 1)
                ->where('expire_status', 0)
                ->where('admin_status', 1)
                ->whereHas('property_agent', function ($query) {
                    $query->where('status', 1);
                    $query->where('approve_profile', 1);
                })
                ->paginate(20)
                ->appends($request->except('page'));
                return view('pages.listing', compact(
                    'town_id_search','city_id_search','district_id_search','type_id_search','agent_id_search','search_text_search','sort_by_search','outlooks_ids_search','location_ids_with_values_search','search_min_price','search_max_price','properties','propertyType','outlooks','locations','agent','apartment_type','apartment_conditionp','apartment_age','apartment_heating','villa_conditionp','villa_age','house_conditionp','house_age','building_conditionp','building_age','land_type','land_status','apartment_elevator','villa_elevator','villa_garden','house_garden','building_elevator','min_apartment_grossm2','max_apartment_grossm2','min_apartment_bed','max_apartment_bed','min_apartment_bath','max_apartment_bath','min_apartment_living','max_apartment_living','min_apartment_floors','max_apartment_floors','min_apartment_building_floors','max_apartment_building_floors','min_villa_grossm2','max_villa_grossm2','min_villa_landm2','max_villa_landm2','min_villa_bed','max_villa_bed','min_villa_bath','max_villa_bath','min_villa_living','max_villa_living','min_villa_floors','max_villa_floors','min_house_grossm2','max_house_grossm2','min_house_landm2','max_house_landm2','min_house_bed','max_house_bed','min_house_bath','max_house_bath','min_house_living','max_house_living','min_house_floors','max_house_floors','min_building_grossm2','max_building_grossm2','min_building_floors','max_building_floors','min_building_flats','max_building_flats','min_building_shops','max_building_shops','min_land_grossm2','max_land_grossm2','type_id_index','city_id','min_price','max_price',                    

                ));
            }
        } catch (\Throwable $th) {

            dd("Something went wrong, please try again!");
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
        public function save(Request $request)
        {
            try {

                $settings = settings::where('id', 1)->first();
                $admin = User::where('id', env('ADMIN_ID'))->first();
                $user = Auth::user();
                if ($user->broker_office_id == '') {
                    return response()->json(['status' => 'false', 'icon' => 'info', 'message' => trans('admin.Please first select a broker office form your profile.')]);
                }
                $amount = 0;
            //            calculate the price to charge from agent
            //            $amount=$settings->create_ad ?? 0;

                if ($request->want_to_highlight == 'true') {
                    $amount += $settings->highlight_in_color;
                }
                $days = 0;
                if ($request->property_duration == 1) {
                    $amount += ($settings->credits_one_month);
                    $days = 30;
                } else if ($request->property_duration == 2) {

                    $amount += ($settings->credits_two_month);
                    $days = 60;
                } else if ($request->property_duration == 3) {

                //                $amount +=($settings->credits_three_month);
                    $amount += 10;
                    $days = 90;
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

                DB::beginTransaction();
                $currentDate = date('d-m-Y');

                $property = Property::create([

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
                    'currency_id' => $request->property_currency,
                    'price' => makeCurrencyInt($request->property_price),

                    'price_in_usd' => convertCurrency($request->property_price, $request->property_currency),

                    'duration' => $request->property_duration,
                    'highlight' => $request->want_to_highlight,
                    'expire_date' => date('d-m-Y', strtotime($currentDate . ' +' . $days . ' days')),
                    'create_date' => date('d-m-Y'),

                ]);

                if ($property) {

                //               charge the user and add the amount to admin balance

                //if login user is not admin then charge it
                    if (Auth::user()->id != $admin->id) {

                        $admin->balance += $amount;
                        $admin->save();

                        $user->balance -= $amount;
                        $user->save();

                    //                add transactions history
                        Transaction::create([
                            'property_id' => $property->id,
                            'user_id' => $user->id,
                            'amount' => $amount,
                            'status' => 'post property',
                            'currency_id' => $request->property_currency,
                            'create_date' => date('d-m-Y'),
                        ]);
                        UseCredits::create([
                            'property_id' => $property->id,
                            'user_id' => $user->id,
                            'amount' => $amount,
                            'status' => 'post property',
                            'currency_id' => $request->property_currency,
                            'create_date' => date('d-m-Y'),
                        ]);
                        Notifications::create([
                            'subject' => 'Property Update',
                            'create_date' => Carbon::now(),
                            'user_id' => $user->id,
                            'message' => 'Your property listing has been successfully created.',
                        ]);
                    }

                //compress add watermark and save property images
                    if ($request->hasFile('files')) {
                        $files = $request->file('files');
                        $preview_image = PropertyImage::saveImage($files, $property->id, true);
                        $property->preview_image = $preview_image;
                    }

                // update the property slug
                    $city = city::where('id', $request->property_city)->first();
                    $slug = "360TR-" . $city->number . "-" . $request->property_type . "-" . $property->id;
                    $property->slug = $slug;
                    $property->save();

                //  save the property attributes
                    if ($request->property_type == 1) {

                        $attribute = ApartmentAttribute::create([
                            'property_type_id' => $request->property_type,
                            'property_id' => $property->id,
                            'price' => $request->property_price,
                            'type' => $request->type,
                            'conditionp' => $request->conditionp,
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

                //send notification
                    $data = [
                        'name' => $user->name,
                        'slug' => $property->slug,
                        'subject' => 'Property Posted',
                        'message' => "Your property is posted successfully, property number is " . $property->slug . ".",
                    ];
                    DB::commit();
                    Notifications::create([
                        'subject' => 'Property Update',
                        'create_date' => Carbon::now(),
                        'user_id' => $user->id,
                        'message' => 'Your property listing has been successfully created.',
                    ]);
                //                $user->notify(new PropertyNotification($data));
                    return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Property saved successfully')]);
                } else {
                    DB::rollback();
                    return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Failed to save property')]);
                }
            } catch (\Throwable $th) {
                DB::rollback();

                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception to save property')]);
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
