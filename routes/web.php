<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\News_cat_adm\News_admController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});

Route::get('/greeting', function () {
    return 'Hello world';
});*/

Route::get('/', function () {
    return view('main');
});

/*Route::get('/template', function () {
    return view('template');
});*/

Route::get('/cat', [CategoriesController::class, 'all']); // вывод всех категорий
Route::get('/news/{id}', [NewsController::class, 'single']); // вывод новости по id
    //->where('id', '\d+');
Route::get('/newscat/{id}', [NewsController::class, 'category']); // вывод новостей категории с указанным id
    //->where('id', '\d+');
Route::get('/admnews', function () { // основная страница администрирования (промежуточная навигация)
    return view('News_cat_adm/news_adm');
});
/*Route::get('/newsadd', function () { // добавление новости
    return view('News_cat_adm/news_add_single');
});*/
Route::get('/newsadd', [News_admController::class, 'create']); // добавление новости