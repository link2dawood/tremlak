<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Languages extends Model
{
    protected $table='language';
    public $timestamps=false;
    protected $fillable=[
        'id',
        'flags',
        'name',
        'short_name',
        'status',
        'default',
        'odr',
    ];
}
