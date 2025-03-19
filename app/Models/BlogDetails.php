<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogDetails extends Model
{
    use HasFactory;
    protected $table='blog_details';
    public $timestamps=false;
    protected $fillable=[
        'id',
        'blog_id',
        'subject',
        'body',
        'lang',
        'lang_id',
        'status'
    ];

    function blog(){
        return $this->belongsTo(Blog::class, 'blog_id','id');
    }
}
