<?php

namespace App\Http\Controllers\Parser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ParserService;
use App\Jobs\NewsParsing;
use App\Models\Source;
use App\Models\News;

class ParserController extends Controller
{
    public function index()
    {
        $start = date('c');
        
        $links = Source::get();
        foreach($links as $link) {
            $url = $link->link;
            NewsParsing::dispatch($url);
        }

        $i = 0;

        while (News::count() == 0 AND $i < 10) {
            sleep(1);
            $i += 1; 
        }

        return redirect('/newsadm');
    }
}
