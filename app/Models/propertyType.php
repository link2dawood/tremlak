<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class propertyType extends Model
{
    use HasFactory;
    protected $table='property_types';
    public $timestamps=false;
    protected $fillable=[
        'id,',
        'position',
        'title',
        'image_path',
        'create_date',
        'status'
    ];

    public function property_type_details()
    {
        // Include condition for the language
        return $this->hasMany(PropertyTypeDetails::class,'property_type_id','id')->where('lang', session('language', 'en'));
    }
    public function details()
    {
        // Include condition for the language
        return $this->hasMany(PropertyTypeDetails::class, 'property_type_id', 'id')->select('title');
    }

    function properties(){
        return $this->hasMany(Property::class);
    }
}
