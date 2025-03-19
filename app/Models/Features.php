<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Features extends Model
{
    use HasFactory;
    protected $table='features';
    public $timestamps=false;
    protected $fillable=[
        'id',
        'title',
        'feature_category_id',
        'status',
    ];
    function category(){
        return $this->belongsTo(FeaturesCategory::class, 'feature_category_id','id');
    }
    public function feature_details()
    {
        // Include condition for the language
        return $this->hasMany(FeaturesDetails::class,'feature_id','id')->where('lang', session('language', 'en'));
    }
    public function details()
    {
        // Include condition for the language
        return $this->hasMany(FeaturesDetails::class, 'feature_id', 'id')->select('title');
    }
}
