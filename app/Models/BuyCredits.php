<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyCredits extends Model
{
    use HasFactory;
    protected $table='buy_credits';
    public $timestamps=false;
    protected $fillable=[
        'id',
        'user_id',
        'payment_type',
        'fname',
        'lname',
        'email',
        'company_name',
        'tax_number',
        'user_id',
        'amount',
        'package_id',
        'discount',
        'currency',
        'status',
        'create_date',
        'expire_date',
    ];

    function package(){
        return $this->belongsTo(CreditPackage::class, 'package_id','id');
    }

    function agent(){
        return $this->belongsTo(User::class, 'user_id','id');
    }

}
