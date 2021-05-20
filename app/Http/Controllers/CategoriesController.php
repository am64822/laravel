<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    private $categories = [
        [
            'id' => 1,
            'title' => 'Категория 1',
            'inform' => ''
        ],
        [
            'id' => 2,
            'title' => 'Категория 2',
            'inform' => ''
        ],
        [
            'id' => 3,
            'title' => 'Категория 3',
            'inform' => ''
        ],
        [
            'id' => 4,
            'title' => 'Категория 4',
            'inform' => ''
        ]
    ];
    

    public function all() { // вывод всех категорий новостей
        $result = array();
        foreach($this->categories as $key => $value) {
                array_push($result, $value);
        }
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
