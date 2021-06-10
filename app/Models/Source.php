<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;

    protected $table = 'sources';
    protected $primaryKey = 'id';
    public $timestamps = false; // will be managed by DB
    //protected $dateFormat = 'U';
    protected $fillable = [
        'link',
        'description',
        'status'
    ];

    public static function rulesMain() {
        return ([
            'link' => 'required',
            'descr' => 'required',
            'status' => 'required'         
        ]);
    }
    public static function attributesMain() {
        return ([
            'link' => "'Ссылка'",
            'descr' => "'Описание'",
            'status' => "'Статус'",         
        ]);
    }
    public static function rulesAdditional() {
        return (['link' => 'unique:sources,link']);
    }
}
