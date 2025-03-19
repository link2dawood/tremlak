<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table='transactions';
    public $timestamps=false;
    protected $fillable=[
        'id',
        'user_id',
        'property_id',
        'amount',
        'currency',
        'status',
        'create_date',
    ];
}
