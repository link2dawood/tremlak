<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturesDetails extends Model
{
    use HasFactory;
    protected $table='features_details';
    public $timestamps=false;
    protected $fillable=[
        'id',
        'feature_id',
        'title',
        'lang',
    ];

    function Outlook(){
        return $this->belongsTo(Features::class, 'feature_id','id');
    }
}
