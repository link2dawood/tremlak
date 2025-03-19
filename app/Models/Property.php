<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $table='properties';
    public $timestamps=false;
    protected $fillable=[
        'id',
        'visitors',
        'user_id',
        'property_type_id',
        'town_id',
        'city_id',
        'district_id',
        'latitude',
        'longitude',
        'outlook_ids',
        'location_ids',
        'location_values',
        'currency_id',
        'price',
        'price_in_usd',
        'duration',
        'highlight',
        'featured',
        'status',
        'admin_status',
        'expire_status',
        'preview_image',
        'expire_date',
        'create_date',
    ];



    function property_type(){
        return $this->belongsTo(propertyType::class, 'property_type_id','id');
    }

    function property_currency(){
        return $this->belongsTo(Currency::class, 'currency_id','id');
    }
    function property_agent(){
        return $this->belongsTo(User::class, 'user_id','id');
    }
    function property_town(){
        return $this->belongsTo(town::class, 'town_id','id');
    }
    function property_city(){
        return $this->belongsTo(city::class, 'city_id','id');
    }
    function property_district(){
        return $this->belongsTo(district::class, 'district_id','id');
    }
    function property_images(){
        return $this->hasMany(PropertyImage::class, 'property_id','id');
    }
    function property_details(){
        return $this->hasMany(filled_dynamic_form::class, 'property_id','id');
    }

    function apartment_attribute(){
        return $this->hasOne(ApartmentAttribute::class, 'property_id','id');
    }
    function villa_attribute(){
        return $this->hasOne(VillaAttribute::class, 'property_id','id');
    }
    function house_attribute(){
        return $this->hasOne(HouseAttribute::class, 'property_id','id');
    }
    function building_attribute(){
        return $this->hasOne(BuildingAttribute::class, 'property_id','id');
    }
    function land_attribute(){
        return $this->hasOne(LandAttribute::class, 'property_id','id');
    }

    // Custom accessor to convert comma-separated string to array
    public function getOutlookIdsAttribute($value)
    {
        return explode(',', $value);
    }
    public function getLocationIdsAttribute($value)
    {
        return explode(',', $value);
    }

    // Method to retrieve associated outlooks
//    public function outlooks()
//    {
//        return Features::whereIn('id', $this->outlook_ids)->where('status',1)->orderBy('title','ASC')->get()->chunk(2);
//    }

// Method to retrieve associated outlooks with their types
    public function outlooks()
    {
        $outlooks = Features::whereIn('id', $this->outlook_ids)->where('status', 1)->orderBy('title', 'ASC')->get();
        $outlooksWithTypes = [];

        foreach ($outlooks as $outlook) {
            $category = $outlook->category->features_category_details[0]->title ?? '';
            $outlooksWithTypes[$category][] = $outlook->feature_details[0]->title;
        }

        return $outlooksWithTypes;
    }

    // Method to retrieve associated locations
    public function near_by_locations()
    {
        return Location::whereIn('id', $this->location_ids)->where('status',1)->get();
    }
}
