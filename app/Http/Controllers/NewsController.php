<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Collection;

class NewsController extends Controller
{    
    public function all() { // show all news
        $news = (new News())->where('status', '=', 'published')->orderBy('updated_at', 'desc')->get();
        return view('news_all', ['news' => $news, 'isAdmin' => false]);
    }
    
    public function single($id) { // show news with the given ID
        $result = (new News())->where('id', '=', $id)->where('status', '=', 'published')->get();
        switch (count($result)) {
            case 0:
                $result = collect();
                break;
            case 1:
                if ($result[0]->status != 'published') {
                    $result = collect();
                };
                break;
            default:
                $result = collect(); // this is DB consistency error. Display that there is no news with the given id      
        }
        return view('news_single', ['id' => $id, 'news_single' => $result]);
    }
    
    public function category($catId) { // show news of the given category 
        // get category name in order to show on the page
        $catExists = false;
        $catTitle = '';
        $news = collect(); // empty news collection
        $cat = (new Category())->where('id', '=', $catId)->get();
        switch (count($cat)) {
            case 0:
                break;
            case 1:
                if ($cat[0]->status == 'published') {
                    $catExists = true;
                    $catTitle = $cat[0]->title;
                    $news = (new News())->where('category_id', '=', $catId)->where('status', '=', 'published')->orderBy('updated_at', 'desc')->get();
                } 
                break;
            default:
                $catTitle = ''; // this is DB consistency error. Display that there are no news of the given category
                $catId = 'DBcons';        
        }

        return view('news_of_cat', ['cat_id' => $catId, 'cat_exists' => $catExists, 'cat_title' => $catTitle, 'newsofcat' => $news]);
    }

}
