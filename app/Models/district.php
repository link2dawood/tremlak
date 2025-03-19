<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class district extends Model
{
    use HasFactory;
    protected $table='districts';
    public $timestamps=false;
    protected $fillable=[
        'id',
        'title',
        'longitude',
        'latitude',
        'city_id',
        'town_id',
        'status'
    ];

    function town_date(){
        return $this->belongsTo(town::class, 'town_id','id');
    }

    function city_date(){
        return $this->belongsTo(city::class, 'city_id','id');
    }
}
