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
            ['link' => 'https://testsource1.com', 'descr' => 'Источник 1'],
            ['link' => 'https://testsource2.com', 'descr' => 'Источник 2'],
            ['link' => 'https://testsource3.com', 'descr' => 'Источник 3'],
            ['link' => 'https://testsource4.com', 'descr' => 'Источник 4'],
            ['link' => 'https://testsource5.com', 'descr' => 'Источник 5'],
            ['link' => 'https://testsource6.com', 'descr' => 'Источник 6'],
            ['link' => 'https://testsource7.com', 'descr' => 'Источник 7'],
            ['link' => 'https://testsource8.com', 'descr' => 'Источник 8'],
            ['link' => 'https://testsource9.com', 'descr' => 'Источник 9'],
            ['link' => 'https://testsource10.com', 'descr' => 'Источник 10']
        ]);

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

        DB::table('news')->insert($news_array);
    }
}
