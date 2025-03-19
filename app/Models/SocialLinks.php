<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialLinks extends Model
{
    use HasFactory;
    protected $table='social_media_links';
    public $timestamps=false;
    protected $fillable=[
        'id',
        'user_id',
        'type',
        'youtube',
        'tiktok',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
    ];

}
