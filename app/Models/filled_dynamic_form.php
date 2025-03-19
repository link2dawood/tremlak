<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class filled_dynamic_form extends Model
{
    use HasFactory;
    protected $table='filled_dynamic_form';
    public $timestamps=false;
    protected $fillable=[
        'id',
        'property_id',
        'label',
        'type',
        'placeholder',
        'value',
    ];
}
