<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'balance',
        'fname',
        'lname',
        'email',
        'password',
        'phone',
        'whatsapp',
        'website',
        'broker_office_id',
        'status',
        'approve_profile',
        'user_type',
        'image_path',
        'email_verified_at',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if ($user->user_type == 0) { // Only for agents
                $user->balance = 100;
            }
        });
    }
    function broker_office(){
        return $this->belongsTo(BrokerOffices::class, 'broker_office_id','id');
    }
    function agent_social_links(){
        return $this->hasOne(SocialLinks::class, 'user_id','id');
    }
    function notifications(){
        return $this->hasMany(Notifications::class, 'user_id','id');
    }
    function activeproperties(){
        return $this->hasMany(Property::class, 'user_id','id')->where('status',1)->where('expire_status',0)->where('admin_status',1)->count();
    }
}
