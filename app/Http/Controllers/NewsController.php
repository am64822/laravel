<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    private $news = [
        [
            'id' => 1,
            'cat_id' => 1,
            'title' => 'Новость 1',
            'inform' => 'Подробная информация'
        ],
        [
            'id' => 2,
            'cat_id' => 1,
            'title' => 'Новость 2',
            'inform' => 'Подробная информация'
        ],
        [
            'id' => 3,
            'cat_id' => 1,
            'title' => 'Новость 3',
            'inform' => 'Подробная информация'
        ],
        [
            'id' => 4,
            'cat_id' => 1,
            'title' => 'Новость 4',
            'inform' => 'Подробная информация'
        ],
        [
            'id' => 5,
            'cat_id' => 2,
            'title' => 'Новость 5',
            'inform' => 'Подробная информация'
        ],
        [
            'id' => 6,
            'cat_id' => 2,
            'title' => 'Новость 6',
            'inform' => 'Подробная информация'
        ],
        [
            'id' => 7,
            'cat_id' => 2,
            'title' => 'Новость 7',
            'inform' => 'Подробная информация'
        ],
        [
            'id' => 8,
            'cat_id' => 2,
            'title' => 'Новость 8',
            'inform' => 'Подробная информация'
        ],
        [
            'id' => 9,
            'cat_id' => 3,
            'title' => 'Новость 9',
            'inform' => 'Подробная информация'
        ],
        [
            'id' => 10,
            'cat_id' => 3,
            'title' => 'Новость 10',
            'inform' => 'Подробная информация'
        ],
        [
            'id' => 11,
            'cat_id' => 3,
            'title' => 'Новость 11',
            'inform' => 'Подробная информация'
        ],
        [
            'id' => 12,
            'cat_id' => 3,
            'title' => 'Новость 12',
            'inform' => 'Подробная информация'
        ],
        [
            'id' => 13,
            'cat_id' => 4,
            'title' => 'Новость 13',
            'inform' => 'Подробная информация'
        ],
        [
            'id' => 14,
            'cat_id' => 4,
            'title' => 'Новость 14',
            'inform' => 'Подробная информация'
        ],
        [
            'id' => 15,
            'cat_id' => 4,
            'title' => 'Новость 15',
            'inform' => 'Подробная информация'
        ],
        [
            'id' => 16,
            'cat_id' => 4,
            'title' => 'Новость 16',
            'inform' => 'Подробная информация'
        ],
        [
            'id' => 17,
            'cat_id' => 4,
            'title' => 'Новость 17',
            'inform' => 'Подробная информация'
        ]
        ];
    
    
    public function single($id) { // show news with the given ID
        $result = array();
        foreach($this->news as $key => $value) {
            if ($value['id'] == $id) {
                array_push($result, $value);
                break;
            }
        }
        return view('news_single', ['news_single' => $result]);
    }
    
    public function category($catId) { // show news of the given category 
        $result = array();
        foreach($this->news as $key => $value) {
            if ($value['cat_id'] == $catId) {
                array_push($result, $value);
            }
        }
        return view('news_of_cat', ['newsofcat' => $result, 'cat_id' => $catId]);
    }

}
