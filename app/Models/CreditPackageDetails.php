<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditPackageDetails extends Model
{
    use HasFactory;
    protected $table='credit_package_details';
    public $timestamps=false;
    protected $fillable=[
        'id',
        'package_id',
        'title',
        'text_1',
        'text_2',
        'description',
        'lang',
    ];

    function creditpackage(){
        return $this->belongsTo(CreditPackage::class, 'package_id','id');
    }
}
