<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    public function all() { // вывод всех категорий новостей
        $result = DB::table('categories')->get();
        return view('categories_all', ['categories' => $result]);    
    }

    public function allAsArray() { // все категории новостей в виде массива (пока нет модели)
        $result = array();
        foreach($this->categories as $key => $value) {
                array_push($result, $value);
        }
        return $result;    
    }

}
