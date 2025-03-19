<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturesCategoryDetails extends Model
{
    use HasFactory;
    protected $table='features_category_details';
    public $timestamps=false;
    protected $fillable=[
        'id',
        'feature_category_id',
        'title',
        'lang',
    ];

    function Outlook(){
        return $this->belongsTo(FeaturesCategory::class, 'feature_category_id','id');
    }
}
