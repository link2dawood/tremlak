<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class BrokerOffices extends Model
{
    protected $table='broker_offices';
    public $timestamps=false;
    protected $fillable=[
        'id',
        'title',
        'certificate_no',
        'certificate_no_later',
        'image_path',
        'city_id',
        'status'
    ];

    function city_date(){
        return $this->belongsTo(city::class, 'city_id','id');
    }

}
