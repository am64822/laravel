<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{    
    public function single($id) { // show news with the given ID
        $result = DB::table('news')->where('id', '=', $id)->get();
        return view('news_single', ['news_single' => $result]);
    }
    
    public function category($catId) { // show news of the given category 
        // get category name in order to show on the page
        $cat_name = DB::table('categories')->where('id', '=', $catId)->get();
        switch (count($cat_name)) {
            case 0:
                $cat_name = $catId;
                break;
            case 1:
                //dd($cat_name[0]);
                $cat_name = $cat_name[0]->title;
                break;
            default:
                $cat_name = ''; // this is DB consistency error. Display that there are no news of the given category
                $catId = 'DBcons';        
        }

        $result = DB::table('news')->where('category_id', '=', $catId)->get();
        return view('news_of_cat', ['newsofcat' => $result, 'cat_id' => $cat_name]);
    }

}
