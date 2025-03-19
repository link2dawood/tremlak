<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class city extends Model
{
    use HasFactory;
    protected $table='cities';
    public $timestamps=false;
    protected $fillable=[
        'id',
        'title',
        'number',
        'position',
        'image_path',
        'status'
    ];

    function properties(){
        return $this->hasMany(Property::class);
    }
    function towns(){
        return $this->hasMany(Property::class);
    }

    function districts(){
        return $this->hasMany(Property::class);
    }
}
