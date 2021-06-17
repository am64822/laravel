<?php

namespace App\Http\Controllers\Parser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ParserYandexArmyService;

class ParserController extends Controller
{
    public function index()
    {
        app(ParserYandexArmyService::class)->parseAndSave();
        return redirect('/newsadm');
    }
}
