<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SourcesCategoriesNewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sources')->insert([
            ['link' => 'https://news.yandex.ru/auto.rss', 'descr' => 'Яндекс.Новости: Авто'],
            ['link' => 'https://news.yandex.ru/auto_racing.rss', 'descr' => 'Яндекс.Новости: Автоспорт'],
            ['link' => 'https://news.yandex.ru/army.rss', 'descr' => 'Яндекс.Новости: Армия и оружие'],
            ['link' => 'https://news.yandex.ru/gadgets.rss', 'descr' => 'Яндекс.Новости: Гаджеты'],
            ['link' => 'https://news.yandex.ru/index.rss', 'descr' => 'Яндекс.Новости: Главное'],
            ['link' => 'https://news.yandex.ru/martial_arts.rss', 'descr' => 'Яндекс.Новости: Единоборства'],
            ['link' => 'https://news.yandex.ru/communal.rss', 'descr' => 'Яндекс.Новости: ЖКХ'],
            ['link' => 'https://news.yandex.ru/health.rss', 'descr' => 'Яндекс.Новости: Здоровье'],
            ['link' => 'https://news.yandex.ru/games.rss', 'descr' => 'Яндекс.Новости: Игры'],
            ['link' => 'https://news.yandex.ru/internet.rss', 'descr' => 'Яндекс.Новости: Интернет'],
            ['link' => 'https://news.yandex.ru/cyber_sport.rss', 'descr' => 'Яндекс.Новости: Киберспорт'],
            ['link' => 'https://news.yandex.ru/movies.rss', 'descr' => 'Яндекс.Новости: Кино'],
            ['link' => 'https://news.yandex.ru/cosmos.rss', 'descr' => 'Яндекс.Новости: Космос'],
            ['link' => 'https://news.yandex.ru/culture.rss', 'descr' => 'Яндекс.Новости: Культура'],
            ['link' => 'https://news.yandex.ru/music.rss', 'descr' => 'Яндекс.Новости: Музыка'],
            ['link' => 'https://news.yandex.ru/nhl.rss', 'descr' => 'Яндекс.Новости: НХЛ']
        ]);
        /*        
        DB::table('categories')->insert([
            ['source_id' => '1', 'title' => 'Категория 1'],
            ['source_id' => '2', 'title' => 'Категория 2'],
            ['source_id' => '3', 'title' => 'Категория 3'],
            ['source_id' => '4', 'title' => 'Категория 4'],
            ['source_id' => '5', 'title' => 'Категория 5'],
            ['source_id' => '5', 'title' => 'Категория 6']
        ]);
        DB::table('categories')->insert([
            ['source_id' => '5', 'title' => 'Категория 7', 'status' => 'hidden']
        ]);


        $news_array;
        $newsCounter = 0;
        for($cat=1;$cat<=5;$cat++) {
            for($sing=1;$sing<=10;$sing++) {
                $newsCounter +=1;
                if ($newsCounter % 2 != 0) {
                    $status = 'draft';
                } else {
                    $status = 'published';
                }
                $news_array[] = array('category_id' => $cat, 'title' => 'Новость ' . $newsCounter, 'content' => 'Подробнее о новости '. $newsCounter, 'status' => $status);
            }
        }

        DB::table('news')->insert($news_array);*/
    }
}
