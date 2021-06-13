<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //public $timestamps = false; // will be managed by DB
     protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function rulesMain() {
        return ([
            'userName' => 'required',
            'email' => 'required|email:rfc',
            'is_admin' => 'required'          
        ]);
    }
    public static function rulesAdditional() {
        return (['email' => 'unique:users,email']);
    }
    public static function attributesMain() {
        return ([
            'userName' => "'Имя пользователя'",
            'email' => "'E-Mail'",
            'is_admin' => "'Админ'",         
        ]);
    }
}
