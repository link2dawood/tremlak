<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table='blogs';
    public $timestamps=false;
    protected $fillable=[
        'id',
        'image_path',
        'slug',
        'mata_description',
        'mata_tags',
        'mata_title',
        'create_date',
        'status'
    ];

    public function blog_details()
    {
        // Include condition for the language
        return $this->hasMany(BlogDetails::class)->where('lang', session()->get('lang', 'en'));
    }
    public function details()
    {
        // Include condition for the language
        return $this->hasMany(BlogDetails::class);
    }
}
