<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditDiscount extends Model
{
    use HasFactory;
    protected $table='discounts';
    public $timestamps=false;
    protected $fillable=[
        'id',
        'package_id',
        'discount',
        'create_date',
        'status'
    ];

    function package(){
       return $this->belongsTo(CreditPackage::class,'package_id','id');
    }

}
