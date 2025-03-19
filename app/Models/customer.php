<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;
    protected $table='customers';
    public $timestamps=false;
    protected $fillable=[
        'id',
        'agency_user_id',
        'fname',
        'lname',
        'passport_number',
        'dob',
        'country',
        'residence',
        'gender',
        'medical_service_id',
        'support_service_id',
        'passport_file',
        'idcard_file',
        'idcard_number',
        'email',
        'phone',
        'status',
        'timestamp',
        'created_date'
    ];

    function agency_user(){
        return $this->belongsTo(User::class, 'agency_user_id','id');
    }

    function orders(){
        return $this->hasMany(orders::class, 'customer_id','id');
    }

    function getMyServices($customer_id,$service_id){

        $my_services=filled_dynamic_form::where('customer_id',$customer_id)->where('assign_services_id',$service_id)->get();

        return $my_services;

    }
}
