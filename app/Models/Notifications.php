<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;
    protected $table='notifications';
    public $timestamps=false;
    protected $fillable=[
        'id',
        'user_id',
        'subject',
        'message',
        'create_date',
    ];

//ALTER TABLE notifications
//ADD CONSTRAINT notifi_user_fk
//FOREIGN KEY (user_id)
//REFERENCES users(id)
//ON DELETE CASCADE;
}
