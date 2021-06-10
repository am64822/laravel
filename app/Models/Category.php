<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'id';
    public $timestamps = false; // will be managed by DB
    //protected $dateFormat = 'U';
    protected $fillable = [
        'source_id',
        'title',
        'status'
    ];

    public static function rulesMain() {
        return ([
            'source_id' => 'required',
            'title' => 'required',
            'status' => 'required'          
        ]);
    }
    public static function attributesMain() {
        return ([
            'source_id' => "'Источник'",
            'title' => "'Наименование'",
            'status' => "'Статус'",         
        ]);
    }
    public static function rulesAdditional() {
        return (['title' => 'unique:categories,title']);
    }
}
