<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationDetails extends Model
{
    use HasFactory;
    protected $table='location_details';
    public $timestamps=false;
    protected $guarded = [];

    function Location(){
        return $this->belongsTo(Location::class, 'location_id','id');
    }
}
