<?php

namespace App\Http\Controllers\News_cat_adm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Source;
use App\Models\Category;

class Sources_admController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('Sources_admController. Index');
        $sources = (new Source())->orderBy('updated_at', 'desc')->get();
        return view('News_cat_adm/sources_adm', ['sources' => $sources]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('News_cat_adm/sources_add_single');
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
            'link' => 'required',
            'descr' => 'required',
            'status' => 'required'
        ]);

        $source = new Source();
        $source->link = $request->link;
        $source->descr = $request->descr;
        $source->status = $request->status;
        $source->save();
        return redirect('/sourcadm'); 
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
        {
            $source = (new Source())->where('id', '=', $id)->get();
            //dd($news);
            return view('News_cat_adm/sources_change_single', ['source' => $source]);
        }
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
            'link' => 'required',
            'descr' => 'required',
            'status' => 'required'
        ]);

        $source = (new Source())->where('id', '=', $id)->get();
        if ($source->count() == 1) {
            $source = $source[0];
            $source->link = $request->link;
            $source->descr = $request->descr;
            $source->status = $request->status;
            //dd('News update id=' . $news[0]->id );
            $source->save();
        }
        return redirect('/sourcadm');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $src = (new Source())->where('id', '=', $id);
        if (($src->count() == 1) AND ((new Category())->where('source_id', '=', $id)->count() == 0)) {
            Source::destroy($id);
        }
        return redirect('/sourcadm');
    }
}
