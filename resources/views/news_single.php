<?php

/* приходят извне 
$news_single
*/

$header = '&nbsp';
$menu = '
<nav>
    <a href="/">Главная</a>
    <a href="/cat">Категории новостей</a>
    <a href="/admnews">Управление новостями</a>
</nav>
';
$content = '';
 


if (count($news_single) == 0) {
    $content = '
        <div>Запрошенной новости нет</div>
    ';
} else {
    foreach($news_single as $key => $value) {
        //$header = 'Новость ' . $value['id'];
        $newsID = $value['id'];
        $category = $value['cat_id'];
        $newsTitle = $value['title'];
        $newsInform =  $value['inform'];
        $content .= "<div><b>{$newsTitle}</b><br>{$newsInform}</div>";         
    }
}


include_once("template.php");