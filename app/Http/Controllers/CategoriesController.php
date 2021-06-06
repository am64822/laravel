<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;


class CategoriesController extends Controller
{
    public function all() { // вывод всех опубликованных категорий новостей
        $result = (new Category())->where('status', '=', 'published')->get();
        return view('categories_all', ['categories' => $result]);    
    }
}
