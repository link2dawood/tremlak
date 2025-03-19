<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class settings extends Model
{
    use HasFactory;
    protected $table='settings';
    public $timestamps=false;
    protected $fillable=[
        'id',
        'site_name',
        'phone_number',
        'email',
        'logo',
        'offer_image',
        'property_expiration_days',
        'credit_expiration_days',
        'create_ad',
        'renew_ad',
        'credits_one_month',
        'credits_two_month',
        'credits_three_month',
        'highlight_in_color',
        'credits_per_image',
        'free_images',
        'seo_author',
        'seo_canonical',
        'seo_description',
        'seo_keywords',
    ];
}
