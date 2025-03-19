<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApartmentAttribute extends Model
{
    use HasFactory;
    protected $table='apartment_attribute';
    public $timestamps=false;
    protected $fillable=[
        'id',
        'property_type_id',
        'property_id',
        'price',
        'type',
        'conditionp',
        'grossm2',
        'netm2',
        'bed_rooms',
        'living_rooms',
        'bath_rooms',
        'age',
        'status',
        'floors',
        'building_floors',
        'heating',
        'elevator',
        'create_date',
    ];

    public function property_type(){

        return $this->belongsTo(propertyType::class,'property_type_id','id');
    }
    public function property(){

        return $this->belongsTo(Property::class,'property_id','id');
    }
}
