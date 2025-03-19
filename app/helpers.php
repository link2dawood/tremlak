<?php

use App\Http\Helpers\Common;
use App\Models\{ApartmentAttribute,
    Banners,
    BuildingAttribute,
    DescriptionTemplate,
    dynamic_form,
    filled_dynamic_form,
    Features,
    HouseAttribute,
    LandAttribute,
    Property,
    PropertyDescription,
    propertyType,
    Settings,
    Currency,
    StartingCities,
    VillaAttribute};
use Illuminate\Support\Facades\{App, Cache, DB};
use Twilio\Http\CurlClient;


if (!function_exists('roundToThousands')) {
    function roundToThousands($price) {
        $roundedPrice = floor($price / 1000) * 1000;
        return $roundedPrice;

    }
}

function convertCurrencySearch($price=0)
{

    if (session()->get('currencyCode')) {
        $currencyCode = session()->get('currencyCode');
    } else {
        $currencyCode = 'USD';
    }

    $price = str_replace(',', '', $price);
    $price = floatval($price);

    $currency_global = Currency::where('code', $currencyCode)->first();
    if ($currency_global) {

        $amount = $price / $currency_global->rate;
        if($amount<1000){
            $amount=1000;
        }
        return $amount;

    }
}

function getCurrencySymbol(){
    if(session()->get('currencyCode')){
        $currencyCode=session()->get('currencyCode');
    }else{
        $currencyCode='USD';
    }

    $currency_global = Currency::where('code',$currencyCode)->first();
    if($currencyCode){
        return $currency_global->symbol;
    }else{
        return "$";
    }
}




function getCurrency($price=0,$currency='',$same_price=0){

    if(session()->get('currencyCode')){
        $currencyCode=session()->get('currencyCode');
    }else{
        $currencyCode='USD';
    }
    $price = str_replace(',', '', $price);
    $price = floatval($price);

    $currency_global = Currency::where('code',$currencyCode)->first();
    if($currency_global){

        $amount= $currency_global->rate*$price;
        $amount = floatval( roundToThousands($amount));

        if($amount<1000){
            $amount=number_format(1000);
        }
        $amount = floatval($amount);
        $amount = number_format($amount);

        if($currencyCode !="USD"){
            $amount=strval($amount);
            $amount=str_replace(',','.',$amount);
        }

        $price= $currency_global->symbol.' '.$amount;
    }else
    {
        $price="$ 1000";
    }
    if($currency == $currency_global->id ){
        $same_price=number_format($same_price);
        if($currencyCode !="USD"){
            $same_price=strval($same_price);
            $same_price=str_replace(',','.',$same_price);
        }
        return $currency_global->symbol.' '.$same_price;
    }

    return $price;
}
function addseparator($price=0){


    if(session()->get('currencyCode')){
        $currencyCode=session()->get('currencyCode');
    }else{
        $currencyCode='USD';
    }

    $amount = number_format($price);

    if($currencyCode !="USD"){
        $amount=strval($amount);
        $amount=str_replace(',','.',$amount);
    }

    return $amount;
}
function makeCurrencyInt($price=0 )
{
    $price = str_replace(',', '', $price);
    $price = str_replace('.', '', $price);
    $price = intval($price);
    return $price;
}
function convertCurrency($price=0 ,$currencyid=''){

    $price=str_replace(',','',$price);
    $price=str_replace('.','',$price);
    $price=intval($price);

    $currency_global = Currency::where('id',$currencyid)->first();
    if($currency_global){

        $price= number_format($price/$currency_global->rate,2);

    }else {

        $price = 0;

    }
    $price=str_replace(',','',$price);
    return $price;
}
function showsaperater($price = 0, $currency = '') {
    // Determine the thousands separator based on the currency
    $thousandsSeparator = ($currency == 'USD') ? ',' : '.';

    // Remove any existing thousands separators (comma or dot)
    $price = str_replace([',', '.'], '', $price);

    // Format the price with the appropriate thousands separator
    if ($currency == 'USD') {
        $formattedPrice = number_format($price, 0, '', ',');
    } else {
        $formattedPrice = number_format($price, 0, '', '.');
    }

    return $formattedPrice;
}

function getImageUrl($imageId, $size = 500) {

    $url = "https://tremlak-blog.shahab01.com/api/assets/image/$imageId?m=bestFit&w=$size";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("api-key:".env('COCKPITAPIKEY')));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        return '';
    }
    return $response;
}
function compiledText($get_text,$property_type_id,$property_id){

    if(session()->get('language')){
        $language=session()->get('language');
    }else{
        $language='en';
    }

    $property=Property::where('id',$property_id)->first();
    $property_type=propertyType::where('id',$property_type_id)->first();
    $desceiption=DescriptionTemplate::where('property_type_id',$property_type_id)->where('lang',$language)->first();
    $required_labels=dynamic_form::where('property_type_id',$property_type_id)->get();
    $filled_labels=filled_dynamic_form::where('property_id',$property_id)->get();
    $outlooks_global=Features::where('status',1)->orderBy('title','ASC')->get();

    $variables = [];

    //selected option base on property type
    if($property_type_id == 1){

        $selected_option=ApartmentAttribute::where('property_id',$property_id)->first();
        $variables['type'] =trans('agent.'.$selected_option->type);
        $variables['conditionp'] =trans('agent.'.$selected_option->conditionp);
        $variables['grossm2'] =$selected_option->grossm2;
        $variables['netm2'] =$selected_option->netm2;
        $variables['bed_rooms'] =$selected_option->bed_rooms;
        $variables['living_rooms'] =$selected_option->living_rooms;
        $variables['bath_rooms'] =$selected_option->bath_rooms;
        $variables['age'] =trans('agent.'.$selected_option->age);
        $variables['status'] =trans('agent.'.$selected_option->status);
        $variables['floors'] =$selected_option->floors;
        $variables['building_floors'] =$selected_option->building_floors;
        $variables['heating'] =$selected_option->heating;
        $variables['elevator'] =$selected_option->elevator;

    }else if($property_type_id == 2){

        $selected_option=VillaAttribute::where('property_id',$property_id)->first();
        $variables['conditionp'] =trans('agent.'.$selected_option->conditionp);
        $variables['grossm2'] =$selected_option->grossm2;
        $variables['netm2'] =$selected_option->netm2;
        $variables['landm2'] =$selected_option->landm2;
        $variables['bed_rooms'] =$selected_option->bed_rooms;
        $variables['living_rooms'] =$selected_option->living_rooms;
        $variables['bath_rooms'] =$selected_option->bath_rooms;
        $variables['age'] =trans('agent.'.$selected_option->age);
        $variables['floors'] =$selected_option->floors;
        $variables['garden'] =trans('agent.'.$selected_option->garden);
    }else if($property_type_id == 3){

        $selected_option=HouseAttribute::where('property_id',$property_id)->first();
        $variables['conditionp'] = trans('agent.'.$selected_option->conditionp);
        $variables['grossm2'] =$selected_option->grossm2;
        $variables['netm2'] =$selected_option->netm2;
        $variables['landm2'] =$selected_option->landm2;
        $variables['bed_rooms'] =$selected_option->bed_rooms;
        $variables['living_rooms'] =$selected_option->living_rooms;
        $variables['bath_rooms'] =$selected_option->bath_rooms;
        $variables['age'] =trans('agent.'.$selected_option->age);
        $variables['floors'] =$selected_option->floors;
        $variables['garden'] =trans('agent.'.$selected_option->garden);
    }else if($property_type_id == 4){
        $selected_option=BuildingAttribute::where('property_id',$property_id)->first();
        $variables['conditionp'] =trans('agent.'.$selected_option->conditionp);
        $variables['grossm2'] =$selected_option->grossm2;
        $variables['flats'] =$selected_option->flats;
        $variables['shops'] =$selected_option->shops;
        $variables['storage_rooms'] =$selected_option->storage_rooms;
        $variables['age'] =trans('agent.'.$selected_option->age);
        $variables['floors'] =$selected_option->floors;
        $variables['elevator'] =trans('agent.'.$selected_option->elevator);

    }else if($property_type_id == 5){
        $selected_option=LandAttribute::where('property_id',$property_id)->first();
        // $variables['type'] =trans('agent.'.$selected_option->type);
        $selected_option = ApartmentAttribute::where('property_id', $property_id)->first();
        // $variables['status'] =trans('agent.'.$selected_option->status);
        if ($selected_option) {
    $variables['status'] = trans('agent.' . $selected_option->status);
} else {
    $variables['status'] = trans('agent.unknown'); // Provide a default value
}

        // $variables['landm2'] =$selected_option->landm2;
if ($selected_option) {
    $variables['landm2'] = $selected_option->landm2;
} else {
    $variables['landm2'] = null; // or provide a default value
}

    }


    //dynamic form inputs add in to variables
    foreach ($required_labels as $key=>$label) {

        // Convert label to snake_case and add to variables array
        $lab_key=str_replace(' ', '_', $label->label);
        if((isset($filled_labels[$key]))  && ($label->label == $filled_labels[$key]->label)){
            $variables[$lab_key] =trans('agent.'.$filled_labels[$key]->value); // You can assign values if needed
        }
    }

    //outlooks add in to variables
    $outlook_ids=$property->outlook_ids;
    foreach ($outlooks_global as $looks) {

        $lab_key=str_replace(' ', '_', $looks->title);
        if(in_array($looks->id,$outlook_ids)){

            $variables[$lab_key] = true;
        }else{
            $variables[$lab_key] = false;
        }

    }

    if($get_text == 'title' ){

        $text= processText($desceiption->title ?? '',$variables);
    }else{
        $text= processText($desceiption->body ?? '',$variables);
    }

    return $text;
}
function processText($text, $variables) {


    $text = preg_replace_callback('/{(.*?)}/', function($matches) use ($variables) {
        $variable_with_condition = trim($matches[1]);

        // Check if the variable has "::" indicating a conditional text
        if (strpos($variable_with_condition, "::") !== false) {
            list($variable_name, $conditional_text) = explode("::", $variable_with_condition);

            // Trim both variable name and conditional text
            $variable_name = trim($variable_name);
            $conditional_text = trim($conditional_text);

            // Check if the conditional text has "||" indicating alternate values
            if (strpos($conditional_text, "||") !== false) {
                list($true_value, $false_value) = explode("||", $conditional_text);

                // Trim both true and false values
                $true_value = trim($true_value);
                $false_value = trim($false_value);

                // Check if the variable name exists in the variables array and if it's true
                if (array_key_exists($variable_name, $variables)) {
                    if($variables[$variable_name]){

                        return $true_value;

                    }else {

                        return $false_value;
                    }

                }else{

                    return $false_value;
                }
            } else {
                // If no alternate values provided, just return the conditional text
                return $conditional_text;
            }
        } else {
            // If the variable doesn't have "::", treat it as a regular variable
            if (array_key_exists($variable_with_condition, $variables)) {
                return $variables[$variable_with_condition];
            } else {
//                return $matches[0];
                return '';
            }
        }
    }, $text);


//    $text = preg_replace('/(?<!\w)\|\s*\|(?=\s*\w)/', '|', $text);
    $text = preg_replace('/\|\s*\|/', ' ', $text);


//    dd($text);
    return $text;
}
function showBlogDescription($htmlContent = '') {
    // Website hostname
    $hostname = env('HOSTNAME');

    // Use DOMDocument to parse the HTML with UTF-8 encoding
    $dom = new DOMDocument();
    $dom->loadHTML('<?xml encoding="UTF-8"/>' . $htmlContent, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

    // Get all img elements
    $images = $dom->getElementsByTagName('img');

    // Iterate through each img element and update the src attribute
    foreach ($images as $image) {
        $src = $image->getAttribute('src');
        // Check if the src is a relative URL
        if (strpos($src, 'http') !== 0) {
            // Concatenate the website hostname with the relative URL
            $newSrc = $hostname . '/' . ltrim($src, '/');
            $image->setAttribute('src', $newSrc);
        }
    }

    // Get the updated HTML content
    $updatedHtmlContent = $dom->saveHTML();

    // Strip the XML declaration added for encoding
    $updatedHtmlContent = substr($updatedHtmlContent, strlen('<?xml encoding="UTF-8"?>'));

    // Output the updated HTML content
    return $updatedHtmlContent;
}
if (!function_exists('getFloorLabel')) {
    function getFloorLabel($floor) {
        if ($floor == 0) {
            return __('agent.Basement');
        }
        $suffix = 'th';
        if ($floor == 1) {
            $suffix = 'st';
        } elseif ($floor == 2) {
            $suffix = 'nd';
        } elseif ($floor == 3) {
            $suffix = 'rd';
        }
//        return $floor . $suffix . ' ' . __('user.floor');
        return $floor . $suffix;
    }
}
function countBycity($city_id){

    $settings=Settings::where('id',1)->first();

    $count = Property::where('city_id',$city_id)
        ->where('status',1)
        ->where('expire_status',0)
        ->where('admin_status',1)
        ->where(DB::raw('REPLACE(REPLACE(price_in_usd, \',\', \'\'), \'.\', \'\')'), '>=', $settings->min_price)
        ->where(DB::raw('REPLACE(REPLACE(price_in_usd, \',\', \'\'), \'.\', \'\')'), '<=', $settings->max_price)
        ->whereHas('property_agent', function ($query) {
            $query->where('status', 1);
            $query->where('approve_profile', 1);
        })
        ->count();
    return $count;

}
function countBytype($type_id){

    $count = Property::where('property_type_id',$type_id)
        ->where('status',1)
        ->where('expire_status',0)
        ->where('admin_status',1)
        ->whereHas('property_agent', function ($query) {
            $query->where('status', 1);
            $query->where('approve_profile', 1);
        })
        ->count();
    return $count;

}





