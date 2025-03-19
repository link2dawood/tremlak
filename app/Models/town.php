<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class town extends Model
{
    use HasFactory;
    protected $table='town';
    public $timestamps=false;
    protected $fillable=[
        'id',
        'city_id',
        'title',
        'status',
    ];

    function city_date(){
        return $this->belongsTo(city::class, 'city_id','id');
    }
}
