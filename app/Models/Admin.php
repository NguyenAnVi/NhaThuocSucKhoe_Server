<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $guarded = 'admin';
    public $timestamps = false;
    protected $fillable = [
        'name', 'phone', 'password',
    ];
    protected $hidden = ['password'];
}

