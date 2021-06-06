<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';
    protected $primaryKey = 'id';
    public $timestamps = false; // will be managed by DB
    //protected $dateFormat = 'U';
    protected $fillable = [
        'category_id',
        'title',
        'content',
        'picture',
        'status'
    ];
}
