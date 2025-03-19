<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BrokerOfficeController;
use App\Http\Controllers\CategoryInputsController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DescriptionController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\FeaturesCategoryController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\TownController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\EmailSettingController;
use App\Http\Controllers\PropertyTypeController;
use App\Http\Controllers\SubscribersController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Visitor;
use Illuminate\Support\Facades\Response;

if (!(isset($_SESSION['language'])) || empty($_SESSION['language']) ){

    $_SESSION['language']='en';
}

if (!(isset($_SESSION['currencyCode'])) || empty($_SESSION['currencyCode']) ) {

    $_SESSION['currencyCode']='USD';
}

$language=$_SESSION['language'];
$currencyCode=$_SESSION['currencyCode'];

//set language
Route::post('setLanguage', [LanguageController::class,'setLanguage'])->name('setLanguage');
Route::post('setCurrency', [LanguageController::class,'setCurrency'])->name('setCurrency');


//run cron jobs
Route::get('expire_credits', [HomeController::class,'expire_credits'])->name('expire_credits');
Route::get('expire_property', [HomeController::class,'expire_property'])->name('expire_property');

//testing
Route::get('testWatermark', [PropertyController::class,'testWatermark'])->name('testWatermark');
Route::get('agent_messages', [HomeController::class, 'messages'])->name('agent_messages');
Route::get('/messages/unread/count', [HomeController::class, 'getUnreadCount'])->name('messages.unread.count');
Route::post('/messages/mark-as-read', [HomeController::class, 'markAsRead'])->name('messages.markAsRead');

//if not found then rediect to home page
Route::fallback(function () {
    return redirect()->route('/');
});

Route::get('admin/visitors/details/{date}', [HomeController::class, 'getVisitorsByDate'])
->name('admin.visitors.details');

Route::post('/auth/google', [LoginController::class, 'redirectToGoogle'])->name('redirectToGoogle');
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);


Route::get('/', [HomeController::class,'index'])->name('/');
Route::get('/home', [HomeController::class,'index'])->name('home');
Route::view('/terms', 'pages.terms')->name('terms');
Route::view('/privacy', 'pages.privacy')->name('privacy');
Route::view('/about', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');
Route::any('view_agents', [UserController::class,'index'])->name('view_agents');
Route::get('agent/{id}', [UserController::class, 'agent_details'])->name('agent_details');

Route::any('/properties/{agent_id?}', [PropertyController::class,'index'])->name('properties');

Route::get('/property_details/{slug}', [PropertyController::class,'details'])->name('property_details');
Route::get('/favorite', [PropertyController::class,'favorite'])->name('favorite');
Route::post('/favorite-render', [PropertyController::class,'favorite_render'])->name('favorite-render');
Route::post('contact_us_submit', [ContactController::class,'add'])->name('contact_us_submit');
Route::post('save_subscriber', [SubscribersController::class, 'add'])->name('save_subscriber');

Route::any('/blogs', [BlogController::class,'index'])->name('blogs');
Route::get('/blog_details/{slug?}', [BlogController::class,'details'])->name('blog_details');

Route::post('/send-message', [HomeController::class, 'sendMessage'])->name('send.message');


// on change requests
Route::post('/get_features_category', [FeaturesCategoryController::class, 'get_features_category'])->name('get_features_category');
Route::post('/get_features_category_listing', [FeaturesCategoryController::class, 'get_features_category_listing'])->name('get_features_category_listing');
Route::post('/get_towns_by_city', [TownController::class, 'get_towns_by_city'])->name('get_towns_by_city');
Route::post('/get_towns_by_city_multiple', [TownController::class, 'get_towns_by_city_multiple'])->name('get_towns_by_city_multiple');
Route::post('/get_districts_by_town', [DistrictController::class, 'get_districts_by_town'])->name('get_districts_by_town');
Route::post('/get_districts_by_town_multiple', [DistrictController::class, 'get_districts_by_town_multiple'])->name('get_districts_by_town_multiple');
Route::post('/get_single_districts', [DistrictController::class, 'get_single_districts'])->name('get_single_districts');


Route::middleware(['auth','verified'])->group(function () {

    Route::get('/dashboard', [HomeController::class,'dashboard'])->name('agent_dashboard');

//    ************************************ Property Management ************************
    Route::get('/my_properties', [PropertyController::class,'my_properties'])->name('my_properties');
    Route::get('/add_property', [PropertyController::class,'add'])->name('add_property');
    Route::post('/save_property', [PropertyController::class,'save'])->name('save_property');
    Route::get('/edit_property/{slug}', [PropertyController::class,'edit'])->name('edit_property');
    Route::post('/update_property', [PropertyController::class,'update'])->name('update_property');
    Route::post('/renew_property', [PropertyController::class,'renew_property'])->name('renew_property');
    Route::post('/delete_property', [PropertyController::class,'delete'])->name('delete_property');
    Route::post('/delete_property_image', [PropertyController::class,'deleteImage'])->name('delete_property_image');
    Route::post('/preview_property_image', [PropertyController::class,'PreviewImage'])->name('preview_property_image');
    Route::post('/update_property_status', [PropertyController::class,'update_status'])->name('update_property_status');
    Route::post('/get_dynamic_inputs_by_categories', [CategoryInputsController::class, 'get_dynamic_inputs_by_categories'])->name('get_dynamic_inputs_by_categories');



    //    ************************* Credits Management **************************
    Route::get('/credits', [TransactionsController::class,'index'])->name('credits');
    Route::post('/get_discounted_credits', [TransactionsController::class,'get_discounted_credits'])->name('get_discounted_credits');
    Route::post('/buy_credits', [TransactionsController::class,'buy_credits'])->name('buy_credits');


    //    ************************************ Notifications Management ************************
    Route::get('/my_notifications', [NotificationController::class,'my_notifications'])->name('notifications');
    Route::post('/notifications/read/{id}', [NotificationController::class, 'markNotificationAsRead'])->name('markNotificationAsRead');


    Route::get('profile',[ProfileController::class,'index'])->name('profile');
    Route::post('update_profile', [ProfileController::class, 'update_profile'])->name('update_profile');
    Route::post('update_profile_image', [ProfileController::class, 'update_profile_image'])->name('update_profile_image');
    Route::post('update_password', [ProfileController::class, 'update_password'])->name('update_password');
    Route::post('update_social_links', [ProfileController::class, 'update_social_links'])->name('update_social_links');
    Route::post('/update_BrokerOffice', [BrokerOfficeController::class, 'update'])->name('update_BrokerOffice');
    //    ********************* SOME SIMPLE Routes ********************

    Route::view('/messages', 'dashboard.messages')->name('messages');
});
Route::prefix('admin')->middleware(['auth','verified','admin'])->group(function () {

    Route::get('/dashboard', [HomeController::class,'admin_dashboard'])->name('dashboard');
    Route::get('/analytics', [HomeController::class,'analytics'])->name('analytics');
    Route::get('/download-visitors', [HomeController::class, 'downloadVisitors'])->name('admin.download.visitors');

//    **************************** Agent Management  **********************
    Route::get('/new_agents', [UserController::class, 'new_agents'])->name('new_agents');
    Route::get('/agents', [UserController::class, 'agents'])->name('agents');
    Route::post('/delete_user', [UserController::class, 'delete'])->name('delete_user');
    Route::post('/update_user_status', [UserController::class, 'updateStatus'])->name('update_user_status');
    Route::post('/approve_profile', [UserController::class, 'approve_profile'])->name('approve_profile');

    // ****************** Notification Management **********************
    Route::post('/send_notification', [NotificationController::class,'add'])->name('send_notification');
    Route::get('/edit_notification/{slug}', [NotificationController::class,'edit'])->name('edit_notification');
    Route::get('/update_notification', [NotificationController::class,'update'])->name('update_notification');
    Route::get('/delete_notification', [NotificationController::class,'delete'])->name('delete_notification');

    //     ********************************* Broker Office management **********************************
    Route::get('/broker_offices', [BrokerOfficeController::class, 'index'])->name('broker_offices');
    Route::post('/save_BrokerOffice', [BrokerOfficeController::class, 'add'])->name('save_BrokerOffice');
    Route::post('/edit_BrokerOffice', [BrokerOfficeController::class, 'edit'])->name('edit_BrokerOffice');

    Route::post('/delete_BrokerOffice', [BrokerOfficeController::class, 'delete'])->name('delete_BrokerOffice');
    Route::post('/update_BrokerOffice_status', [BrokerOfficeController::class, 'updateStatus'])->name('update_BrokerOffice_status');
    Route::post('/get_broker_offices', [BrokerOfficeController::class, 'get_broker_offices'])->name('get_broker_offices');


    //     ********************************* Property Types management **********************************

    Route::get('/property_types', [PropertyTypeController::class, 'index'])->name('property_types');
    Route::post('/save_propertyType', [PropertyTypeController::class, 'add'])->name('save_propertyType');
    Route::post('/edit_propertyType', [PropertyTypeController::class, 'edit'])->name('edit_propertyType');
    Route::post('/update_propertyType', [PropertyTypeController::class, 'update'])->name('update_propertyType');
    Route::post('/delete_propertyType', [PropertyTypeController::class, 'delete'])->name('delete_propertyType');
    Route::post('/update_propertyType_status', [PropertyTypeController::class, 'updateStatus'])->name('update_propertyType_status');
    Route::post('/get_property_type_details', [PropertyTypeController::class, 'get_property_type_details'])->name('get_property_type_details');


//     ********************************* Property management **********************************

    Route::get('/properties', [PropertyController::class, 'admin_properties'])->name('properties_admin');
    Route::post('/update_property_admin_status', [PropertyController::class,'updateAdminStatus'])->name('update_property_admin_status');
    Route::post('/delete_property_admin', [PropertyController::class,'delete'])->name('delete_property');


    //     ********************************* Features Category management **********************************

    Route::get('/features_category', [FeaturesCategoryController::class, 'index'])->name('features_category');
    Route::post('/save_features_category', [FeaturesCategoryController::class, 'add'])->name('save_features_category');
    Route::post('/edit_features_category', [FeaturesCategoryController::class, 'edit'])->name('edit_features_category');
    Route::post('/update_features_category', [FeaturesCategoryController::class, 'update'])->name('update_features_category');
    Route::post('/delete_features_category', [FeaturesCategoryController::class, 'delete'])->name('delete_features_category');
    Route::post('/update_features_category_status', [FeaturesCategoryController::class, 'updateStatus'])->name('update_features_category_status');
    Route::post('/get_features_category_details', [FeaturesCategoryController::class, 'get_features_category_details'])->name('get_features_category_details');


    //     ********************************* Property Outlooks management **********************************

    Route::get('/features', [FeatureController::class, 'index'])->name('features');
    Route::post('/save_feature', [FeatureController::class, 'add'])->name('save_feature');
    Route::post('/edit_feature', [FeatureController::class, 'edit'])->name('edit_feature');
    Route::post('/update_feature', [FeatureController::class, 'update'])->name('update_feature');
    Route::post('/delete_feature', [FeatureController::class, 'delete'])->name('delete_feature');
    Route::post('/update_feature_status', [FeatureController::class, 'updateStatus'])->name('update_feature_status');
    Route::post('/get_feature_details', [FeatureController::class, 'get_feature_details'])->name('get_feature_details');

    //     ********************************* Property Locations management **********************************

    Route::any('/locations', [LocationController::class, 'index'])->name('locations');
    Route::post('/save_location', [LocationController::class, 'add'])->name('save_location');
    Route::post('/edit_location', [LocationController::class, 'edit'])->name('edit_location');
    Route::post('/update_location', [LocationController::class, 'update'])->name('update_location');
    Route::post('/delete_location', [LocationController::class, 'delete'])->name('delete_location');
    // Route::post('/update_location_status', [LocationController::class, 'updateStatus'])->name('update_location_status');
    Route::post('/update_location_status', [LocationController::class, 'updateStatus'])->name('update_location_status');

    Route::post('/get_location_details', [LocationController::class, 'get_location_details'])->name('get_location_details');
    Route::post('update_location', [LocationController::class, 'update_location'])->name('update_location');
    //     ********************************* Category Inputs management **********************************
    Route::get('/inputs', [CategoryInputsController::class, 'index'])->name('inputs');
    Route::post('/get_subServices_by_mainService', [CategoryInputsController::class, 'get_subServices_by_mainService'])->name('get_subServices_by_mainService');
    Route::post('/save_dynamic_inputs', [CategoryInputsController::class, 'save'])->name('save_dynamic_inputs');
    Route::post('/edit_dynamic_inputs', [CategoryInputsController::class, 'edit'])->name('edit_dynamic_inputs');
    Route::post('/delete_dynamic_inputs', [CategoryInputsController::class, 'delete'])->name('delete_dynamic_inputs');
    Route::post('/search_category_inputs', [CategoryInputsController::class, 'search_category_inputs'])->name('search_category_inputs');


    //     ********************************* Cities management **********************************
    Route::get('/cities', [CityController::class, 'index'])->name('cities');
    Route::post('/save_city', [CityController::class, 'add'])->name('save_city');
    Route::post('/edit_city', [CityController::class, 'edit'])->name('edit_city');
    Route::post('/update_city', [CityController::class, 'update'])->name('update_city');
    Route::post('/delete_city', [CityController::class, 'delete'])->name('delete_city');
    Route::post('/update_city_status', [CityController::class, 'updateStatus'])->name('update_city_status');
    Route::post('/update_show_on_home_status', [CityController::class, 'updateShowOnHomeStatus'])->name('update_show_on_home_status');

    //     ********************************* Towns management **********************************

    Route::any('/towns', [TownController::class, 'index'])->name('towns');
    Route::post('/save_town', [TownController::class, 'add'])->name('save_town');
    Route::post('/edit_town', [TownController::class, 'edit'])->name('edit_town');
    Route::post('/update_town', [TownController::class, 'update'])->name('update_town');
    Route::post('/delete_town', [TownController::class, 'delete'])->name('delete_town');
    Route::post('/update_town_status', [TownController::class, 'updateStatus'])->name('update_town_status');


    //     ********************************* Districts management **********************************
    Route::any('/districts', [DistrictController::class, 'index'])->name('districts');
    Route::post('/save_district', [DistrictController::class, 'add'])->name('save_district');
    Route::post('/edit_district', [DistrictController::class, 'edit'])->name('edit_district');
    Route::post('/update_district', [DistrictController::class, 'update'])->name('update_district');
    Route::post('/delete_district', [DistrictController::class, 'delete'])->name('delete_district');
    Route::post('/update_district_status', [DistrictController::class, 'updateStatus'])->name('update_district_status');


        //     ********************************* Credit Packages management **********************************
    Route::get('/packages', [PackageController::class, 'index'])->name('packages');
    Route::post('/save_package', [PackageController::class, 'add'])->name('save_package');
    Route::post('/edit_package', [PackageController::class, 'edit'])->name('edit_package');
    Route::post('/update_package', [PackageController::class, 'update'])->name('update_package');
    Route::post('/delete_package', [PackageController::class, 'delete'])->name('delete_package');
    Route::post('/update_package_status', [PackageController::class, 'updateStatus'])->name('update_package_status');
    Route::post('/get_packages_details', [PackageController::class, 'get_packages_details'])->name('get_packages_details');

    //     ********************************* Credit Discounts management **********************************
    Route::get('/discounts', [DiscountController::class, 'index'])->name('discounts');
    Route::post('/save_discount', [DiscountController::class, 'add'])->name('save_discount');
    Route::post('/edit_discount', [DiscountController::class, 'edit'])->name('edit_discount');
    Route::post('/update_discount', [DiscountController::class, 'update'])->name('update_discount');
    Route::post('/delete_discount', [DiscountController::class, 'delete'])->name('delete_discount');
    Route::post('/update_discount_status', [DiscountController::class, 'updateStatus'])->name('update_discount_status');

        //     ********************************* Credits Transactions management **********************************
    Route::get('/credits_overview', [TransactionsController::class, 'credits_overview'])->name('credits_overview');
    Route::post('/assign-credits', [TransactionsController::class, 'assignCredits'])->name('assignCredits');
    Route::get('/agent-balance/{id}', [TransactionsController::class, 'viewAgentBalance'])->name('agent-balance-view');

    Route::get('/export-agent-credits/{id}', [TransactionsController::class, 'exportAgentCredits'])->name('export-agent-credits');

    Route::get('/credits/export', [TransactionsController::class, 'exportCredits'])->name('credits.export');




    //     ********************************* Currency management **********************************

    Route::get('/currency', [CurrencyController::class, 'index'])->name('currency');
    Route::post('/save_currency', [CurrencyController::class, 'add'])->name('save_currency');
    Route::post('/edit_currency', [CurrencyController::class, 'edit'])->name('edit_currency');
    Route::post('/update_currency', [CurrencyController::class, 'update'])->name('update_currency');
    Route::post('/delete_currency', [CurrencyController::class, 'delete'])->name('delete_currency');
    Route::post('/update_currency_status', [CurrencyController::class, 'updateStatus'])->name('update_currency_status');
    Route::post('/update_currency_rate', [CurrencyController::class, 'updateRate'])->name('update_currency_rate');

    Route::get('/language', [LanguageController::class, 'index'])->name('languages');
    Route::post('/language/create', [LanguageController::class, 'create'])->name('save_language');
    Route::get('/language/create', [LanguageController::class, 'create'])->name('save_language');
    // Route to fetch language details (GET request)
    Route::get('/languages/edit/{id}', [LanguageController::class, 'edit'])->name('edit_language');

// Route to update language (POST request)
    Route::put('/languages/update/{id}', [LanguageController::class, 'update'])->name('update_language');

    Route::delete('/language/delete/{id}', [LanguageController::class, 'delete'])->name('delete_language');

    //********************************* Subscribers management **********************************
    Route::get('/subscribers', [SubscribersController::class, 'index'])->name('subscribers');
    Route::post('delete_subscriber', [SubscribersController::class, 'delete'])->name('delete_subscriber');

    //********************************* Messages management **********************************
    Route::get('/admin_messages', [ContactController::class, 'index'])->name('admin_messages');
    Route::post('/delete_message', [ContactController::class, 'delete'])->name('delete_message');

    //********************************* Blogs management **********************************

    Route::get('/add_blog', [BlogController::class, 'add'])->name('add_blog');
    Route::get('/blogs', [BlogController::class, 'all'])->name('admin_blogs');
    Route::post('/upload-image', [BlogController::class, 'upload'])->middleware('web')->name('upload-image');
    Route::post('save_blog', [BlogController::class, 'save'])->name('save_blog');
    Route::get('/update_blog/{slug}', [BlogController::class,'edit'])->name('update_blog');
    Route::post('/update', [BlogController::class,'update'])->name('update_blog_save');
    Route::post('/update_blog_status', [BlogController::class, 'updateStatus'])->name('update_blog_status');
    Route::post('/delete_blog', [BlogController::class, 'delete'])->name('delete_blog');


    //     ********************************* Description template management **********************************
    Route::any('/description_template', [DescriptionController::class, 'index'])->name('description_template');
    Route::post('/description_template_update', [DescriptionController::class, 'update'])->name('description_template_update');
    //     ********************************* settings management **********************************
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/update_settings', [SettingsController::class, 'update'])->name('update_settings');
    Route::post('/update_charges_amount', [SettingsController::class, 'update_charges_amount'])->name('update_charges_amount');
    Route::post('/update_seo_links', [SettingsController::class, 'update_seo_links'])->name('update_seo_links');
    Route::post('/update_stripe_keys', [SettingsController::class, 'update_stripe_keys'])->name('update_stripe_keys');
    Route::post('/remove_credits_offer_image', [SettingsController::class, 'remove_credits_offer_image'])->name('remove_credits_offer_image');
    Route::post('/update-email-detail', [EmailSettingController::class, 'update'])->name('update-email-detail');
    Route::post('/update_social_links_settings', [ProfileController::class, 'update_social_links'])->name('update_social_links');
});

require __DIR__.'/auth.php';
