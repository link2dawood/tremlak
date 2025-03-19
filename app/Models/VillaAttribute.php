<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillaAttribute extends Model
{
    use HasFactory;
    protected $table='villa_attribute';
    public $timestamps=false;
    protected $fillable=[
        'id',
        'property_type_id',
        'property_id',
        'price',
        'conditionp',
        'grossm2',
        'netm2',
        'landm2',
        'bed_rooms',
        'living_rooms',
        'bath_rooms',
        'age',
        'floors',
        'elevator',
        'garden',
        'create_date',
    ];

    public function property_type(){

        return $this->belongsTo(propertyType::class,'property_type_id','id');
    }
    public function property(){

        return $this->belongsTo(Property::class,'property_id','id');
    }
}
