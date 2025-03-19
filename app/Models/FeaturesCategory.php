<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturesCategory extends Model
{
    use HasFactory;
    protected $table='features_category';
    public $timestamps=false;
    protected $fillable=[
        'id',
        'title',
        'property_type_id',
        'status',
    ];

    function propertyType(){
        return $this->belongsTo(propertyType::class, 'property_type_id','id');
    }
    public function features_category_details()
    {
        // Include condition for the language
        return $this->hasMany(FeaturesCategoryDetails::class,'feature_category_id','id')->where('lang', session('language', 'en'));
    }
    public function features()
    {
        // Include condition for the language
        return $this->hasMany(Features::class, 'feature_category_id', 'id');
    }
}
