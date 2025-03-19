<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Location extends Model
{
    use HasFactory;
    protected $table='locations';
    public $timestamps=false;
    protected $guarded = [];

    public function location_details()
    {
        // Include condition for the language
        return $this->hasMany(LocationDetails::class,'location_id','id')->where('lang', session('language', 'en'));
    }
    public function location_details_en()
    {
        // Include condition for the language
        return $this->hasMany(LocationDetails::class,'location_id','id')->where('lang', 'en');
    }
    public function details()
    {
        // Include condition for the language
        return $this->hasMany(LocationDetails::class, 'location_id', 'id')->select('title');
    }
}
