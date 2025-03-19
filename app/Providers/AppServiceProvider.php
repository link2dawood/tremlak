<?php

namespace App\Providers;

use App\Models\BrokerOffices;
use App\Models\city;
use App\Models\Currency;
use App\Models\district;
use App\Models\Languages;
use App\Models\Features;
use App\Models\town;
use App\Models\mainService;
use App\Models\settings;
use App\Models\propertyType;
use App\Models\SocialLinks;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $broker_offices_global = BrokerOffices::where('status',1)->orderBY('title', 'ASC')->get();
        View::share('broker_offices_global', $broker_offices_global);

        $cities_global=city::where('status',1)->orderBy('position','ASC')->get();
        View::share('cities_global', $cities_global);

        $provinces_global=town::where('status',1)->orderBy('title','ASC')->get();
        View::share('provinces_global', $provinces_global);

        $districts_global=district::where('status',1)->orderBy('title','ASC')->get();
        View::share('districts_global', $districts_global);

        // $propertyType_global = PropertyType::where('status', 1)
        //     ->with(['property_type_details' => function ($query) {
        //         $query->orderBy('title', 'ASC');
        //     }])
        //     ->get()
        //     ->sortBy(function($type) {
        //         return $type->property_type_details->isNotEmpty()
        //             ? $type->property_type_details[0]->title
        //             : '';
        //     });
        
        $propertyType_global = PropertyType::where('status', 1)
            ->orderBy('position', 'ASC') // Order by 'position' from PropertyType table
            ->get();


            View::share('propertyType_global', $propertyType_global);


            $outlooks_global=Features::where('status',1)->orderBy('title','ASC')->get();
            View::share('outlooks_global', $outlooks_global);

            $currency_global = Currency::where('status', 1)
            ->orderByRaw("CASE WHEN odr = '' THEN 999999 ELSE CAST(odr AS UNSIGNED) END ASC")
            ->get();
            View::share('currency_global', $currency_global);


            $language_global = Languages::where('status', 1)
            ->orderBy('odr', 'ASC')
            ->get();

            View::share('language_global', $language_global);

            $social_links=SocialLinks::where('type','website')->first();
            View::share('social_links', $social_links);

            $settings=settings::where('id',1)->first();
            View::share('settings', $settings);

            Paginator::useBootstrap();
        }
    }
