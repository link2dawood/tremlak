<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DescriptionTemplate extends Model
{
    use HasFactory;
    protected $table='description_templates';
    public $timestamps=false;
    protected $fillable=[
        'id',
        'property_type_id',
        'title',
        'body',
        'lang',
        'lang_id',
    ];

}
