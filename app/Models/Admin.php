<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'admins';

    protected $guarded = 'admin';

    public $timestamps = false;

    protected $fillable = [
        'name', 'phone', 'password',
    ];

    protected $hidden = [
        'remember_token','password', 'created_at', 'updated_at'

    ];

    public function scopeName($query, $request)
    {
        if ($request->has('name_filter')) {
            $query->where('name', 'LIKE', '%' . $request->input('name') . '%');
        }

        return $query;
    }
    public function scopePhone($query, $request)
    {
        if ($request->has('phone_filter')) {
            $query->where('phone', 'LIKE', '%' . $request->input('phone') . '%');
        }

        return $query;
    }
    public function scopePoint($query, $request)
    {
        if ($request->has('point_filter')) {
            $query->where('point', 'LIKE', '%' . $request->input('point') . '%');
        }

        return $query;
    }
}

