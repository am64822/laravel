<?php

namespace App\Services;
use Orchestra\Parser\Xml\Facade as XmlParser;
use App\Models\News;
use App\Models\Category;
use App\Models\Source;

class ParserService 
{
    public function parseAndSave($url) {
    
        $soFarsoGood = true;
            
        try {
            $xml = XmlParser::load($url);
        } catch (Exception $e) {
            $soFarsoGood = false;
            return;
        }
        
        
        $data = $xml->parse([
            'title' => ['uses' => 'channel.title'],
            'link' => ['uses' => 'channel.link'],
            'description' => ['uses' => 'channel.description'],
            'image' => ['uses' => 'channel.image.url'],
            'news' => ['uses' => 'channel.item[title,link,guid,description,pubDate]'],
        ]);

        $source = Source::where('link', '=', $url)->get();
        if($source->count() == 0) {
            // DB consistency error
            $soFarsoGood = false;
            return;
        } elseif ($source->count() == 1) {
            $categorySourceId = $source[0]->id;
        } else {
            // DB consistency error
            $soFarsoGood = false;
            return;
        }

        $category = Category::where('title', '=', $data['title'])->get();
        if($category->count() == 0) {
            $category = new Category();
            $category->source_id = $categorySourceId;
            $category->title = $data['title'];
            $category->status = 'published';
            $category->save();
            $categoryId = $category->id;
        } elseif ($category->count() == 1) {
            $categoryId = $category[0]->id;
        } else {
            // DB consistency error
            $soFarsoGood = false;
            return;
        }

        $news = $data['news'];
        $newsCount = count($news);

        if ($newsCount > 0) {
            for ($i = 0; $i <= ($newsCount - 1); $i++) {
                preg_match('/(--)([0-9a-zA-Z]){1,}\?/', $news[$i]['guid'], $matches);
                if (isset($matches[0]) == true) {
                    $guid = substr($matches[0], 0, -1);
                    $guid = substr($guid, 2);
                    $news[$i]['guid'] = $guid;
                } else {
                    continue;
                }
                
                $newsSingle = News::where('guid', '=', $news[$i]['guid'])->get();
                if ($newsSingle->count() == 0) {
                    $newsSingle = new News();
                    $newsSingle->category_id = $categoryId;
                    $newsSingle->guid = $news[$i]['guid'];
                    $newsSingle->title = $news[$i]['title'];
                    $newsSingle->content = $news[$i]['description'];
                    $newsSingle->status = 'published';
                    $newsSingle->save();
                }

            }
        }

    }
}