<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\{CategoriesController, FeedbackController, Download_requestController};
use App\Http\Controllers\News_cat_adm\{Sources_admController, Cats_admController, News_admController};
use App\Http\Controllers\UsersAdm\{UsersAdmController};

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

Route::get('/cat', [CategoriesController::class, 'all']); // вывод всех опубликованных категорий
Route::get('/newsall', [NewsController::class, 'all']); // вывод всех опубликованных новостей
Route::get('/news/{id}', [NewsController::class, 'single']); // вывод опубликованной новости по id
    //->where('id', '\d+');
Route::get('/newscat/{id}', [NewsController::class, 'category']); // вывод опубликованной категории по id
    //->where('id', '\d+');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/feedback', [FeedbackController::class, 'show']); // обратная связь, показать
    Route::post('/feedback', [FeedbackController::class, 'save']); // обратная связь, сохранить
    Route::get('/downlreq', [Download_requestController::class, 'show']); // запрос на выгрузку, показать
    Route::post('/downlreq', [Download_requestController::class, 'save']); // запрос на выгрузку, сохранить
});

Route::group(['middleware' => ['auth', 'isAdmin']], function() {
    Route::get('/adm', function () { // основная страница администрирования (промежуточная навигация)
            return view('News_cat_adm/adm');
        });

    Route::get('/sourcadm', [Sources_admController::class, 'index']); // управление источниками
    Route::get('/srcadm/add', [Sources_admController::class, 'create']); // добавление источника, показать пустую форму
    Route::post('/srcadm/add', [Sources_admController::class, 'store']); // добавление источника, сохранить
    Route::get('/srcadm/edit/{id}', [Sources_admController::class, 'edit']); // изменение источника, показать форму
    Route::post('/srcadm/edit/{id}', [Sources_admController::class, 'update']); // изменение источника, сохранить
    Route::delete('/srcadm/del/{id}', [Sources_admController::class, 'destroy']); // удаление источника

    Route::get('/catsadm', [Cats_admController::class, 'index']); // управление категориями
    Route::get('/catsadm/add', [Cats_admController::class, 'create']); // добавление категории, показать пустую форму
    Route::post('/catsadm/add', [Cats_admController::class, 'store']); // добавление категории, сохранить
    Route::get('/catsadm/edit/{id}', [Cats_admController::class, 'edit']); // изменение категории, показать форму
    Route::post('/catsadm/edit/{id}', [Cats_admController::class, 'update']); // изменение категории, сохранить
    Route::delete('/catsadm/del/{id}', [Cats_admController::class, 'destroy']); // удаление категории

    Route::get('/newsadm', [News_admController::class, 'index']); // управление новостями
    Route::get('/newsadm/add', [News_admController::class, 'create']); // добавление новости, показать пустую форму
    Route::post('/newsadm/add', [News_admController::class, 'store']); // добавление новости, сохранить
    Route::get('/newsadm/edit/{id}', [News_admController::class, 'edit']); // изменение новости, показать форму
    Route::post('/newsadm/edit/{id}', [News_admController::class, 'update']); // изменение новости, сохранить
    Route::delete('/newsadm/del/{id}', [News_admController::class, 'destroy']); // удаление новости

    Route::get('/usersadm', [UsersAdmController::class, 'index']); // управление пользователями
    Route::get('/usersadm/edit/{id}', [UsersAdmController::class, 'edit']); // изменение атрибутов пользователя, показать форму
    Route::post('/usersadm/edit/{id}', [UsersAdmController::class, 'update']); // изменение атрибутов пользователя, сохранить
    Route::delete('/usersadm/del/{id}', [UsersAdmController::class, 'destroy']); // удаление пользователя
});

Route::get('/reset-password', function () {
    return view('main');
});