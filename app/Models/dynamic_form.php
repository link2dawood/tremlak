<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dynamic_form extends Model
{
    use HasFactory;
    protected $table='dynamic_form';
    public $timestamps=false;
    protected $fillable=[
        'id',
        'property_type_id',
        'label',
        'type',
        'placeholder',
        'position',
        'create_date',
    ];

    function property_type_data(){
        return $this->belongsTo(propertyType::class, 'property_type_id','id');
    }

}
