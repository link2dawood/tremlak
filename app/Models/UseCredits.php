<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UseCredits extends Model
{
    use HasFactory;

    protected $table = 'use_credits';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'user_id',
        'property_id',
        'amount',
        'currency_id',
        'status',
        'create_date',
    ];

    function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }
    function agent(){
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
