<?php

namespace App\Http\Controllers\News_cat_adm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;

class News_admController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = (new News())->join('categories', 'news.category_id', '=', 'categories.id')->select('news.id', 'news.title as newstitle', 'categories.title as cattitle', 'news.content', 'news.picture', 'news.status as newsstatus', 'news.updated_at as newsupdat')->orderBy('newsupdat', 'desc')->get();
        //dd($news);
        return view('News_cat_adm/news_adm', ['news' => $news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats_list = (new Category())->where('status', '=', 'published')->get();
        return view('News_cat_adm/news_add_single', ['cats_list' => $cats_list]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([ 
            'category_id' => 'required',
            'title' => 'required',
            'content' => 'required',
            'status' => 'required'
        ]);

        $news = new News();
        $news->category_id = $request->category_id;
        $news->title = $request->title;
        $news->content = $request->content;
        $news->status = $request->status;
        $news->save();
        return redirect('/newsadm'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cats_list = (new Category())->where('status', '=', 'published')->get();
        $news = (new News())->where('id', '=', $id)->get();
        //dd($news);
        return view('News_cat_adm/news_change_single', ['cats_list' => $cats_list, 'news' => $news]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([ 
            'category_id' => 'required',
            'title' => 'required',
            'content' => 'required',
            'status' => 'required'
        ]);

        $news = (new News())->where('id', '=', $id)->get();
        if ($news->count() == 1) {
            $news = $news[0];
            $news->category_id = $request->category_id;
            $news->title = $request->title;
            $news->content = $request->content;
            $news->status = $request->status;
            //dd('News update id=' . $news[0]->id );
            $news->save();
        }
        return redirect('/newsadm');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = (new News())->where('id', '=', $id);
        if ($news->count() == 1) {
            News::destroy($id);
        }
        return redirect('/newsadm');
    }
}
