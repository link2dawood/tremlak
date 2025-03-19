<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyTypeDetails extends Model
{
    use HasFactory;
    protected $table='property_types_details';
    public $timestamps=false;
    protected $fillable=[
        'id',
        'property_type_id',
        'title',
        'lang',
    ];

    function PropertyType(){
        return $this->belongsTo(propertyType::class, 'property_type_id','id');
    }
}
