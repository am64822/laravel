<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Downlreq extends Model
{
    use HasFactory;

    protected $table = 'downlreqs';
    protected $primaryKey = 'id';
    public $timestamps = false; // will be managed by DB
    //protected $dateFormat = 'U';
    protected $fillable = [
        'user_name',
        'phone',
        'email',
        'content'
    ];
}
