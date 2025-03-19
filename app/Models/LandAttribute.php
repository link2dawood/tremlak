<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandAttribute extends Model
{
    use HasFactory;
    protected $table='land_attribute';
    public $timestamps=false;
    protected $fillable=[
        'id',
        'property_type_id',
        'property_id',
        'price',
        'pricem2',
        'type',
        'status',
        'landm2',
        'create_date',
    ];

    public function property_type(){

        return $this->belongsTo(propertyType::class,'property_type_id','id');
    }
    public function property(){

        return $this->belongsTo(Property::class,'property_id','id');
    }
}
