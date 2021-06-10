<?php

namespace App\Http\Controllers\News_cat_adm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Source;
use App\Models\Category;
use App\Models\News;

class Cats_admController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = (new Category())->join('sources', 'categories.source_id', '=', 'sources.id')->select('categories.id', 'categories.title as cattitle', 'sources.link as srclink', 'categories.status as cattatus', 'categories.updated_at as catupdat')->orderBy('catupdat', 'desc')->get();
        //dd($cats);
        return view('News_cat_adm/cats_adm', ['cats' => $cats]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $src_list = (new Source())->where('status', '=', 'published')->get();
        return view('News_cat_adm/cats_add_single', ['src_list' => $src_list]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Category::rulesMain(), [], Category::attributesMain());
        $this->validate($request, Category::rulesAdditional(), [], Category::attributesMain());  
        /*$validated = $request->validate([ 
            'source_id' => 'required',
            'title' => 'required|unique:categories,title',
            'status' => 'required'
        ]);*/

        $cat = new Category();
        $cat->source_id = $request->source_id;
        $cat->title = $request->title;
        $cat->status = $request->status;
        $cat->save();
        return redirect('/catsadm'); 
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
        $src_list = (new Source())->where('status', '=', 'published')->get();
        $cat = (new Category())->where('id', '=', $id)->get();
        //dd($news);
        return view('News_cat_adm/cats_change_single', ['src_list' => $src_list, 'cat' => $cat]);
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
        $this->validate($request, Category::rulesMain(), [], Category::attributesMain()); 
        /*$validated = $request->validate([ 
            'source_id' => 'required',
            'title' => 'required',
            'status' => 'required'
        ]);*/
        
        
        if ($request->title != $request->titleInitial) {
            $this->validate($request, Category::rulesAdditional(), [], Category::attributesMain()); 
            /*$validated = $request->validate([ 
                'title' => 'unique:categories,title'
            ]);*/
        }

        $cat = (new Category())->where('id', '=', $id)->get();
        if ($cat->count() == 1) {
            $cat = $cat[0];
            $cat->source_id = $request->source_id;
            $cat->title = $request->title;
            $cat->status = $request->status;
            $cat->save();
        }
        return redirect('/catsadm');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = (new Category())->where('id', '=', $id);
        if (($cat->count() == 1) AND ((new News())->where('category_id', '=', $id)->count() == 0)) {
            Category::destroy($id);
        }
        return redirect('/catsadm');
    }
}
