<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditPackage extends Model
{
    use HasFactory;
    protected $table='credit_packages';
    public $timestamps=false;
    protected $fillable=[
        'id',
        'credits',
        'price',
        'color',
        'create_date',
        'status'
    ];
    public function package_details()
    {
        // Include condition for the language
        return $this->hasMany(CreditPackageDetails::class,'package_id','id')->where('lang', session('language', 'en'));
    }
    public function details()
    {
        // Include condition for the language
        return $this->hasMany(CreditPackageDetails::class, 'package_id', 'id')->select('title');
    }
}
