<?php

/* приходят извне 
$cat_id
$newsofcat
*/

$header = 'Новости категории ' . $cat_id;
$menu = '
<nav>
    <a href="/">Главная</a>
    <a href="/cat">Категории новостей</a>
    <a href="/admnews">Управление новостями</a>
</nav>
';
$content = '';
 
if (count($newsofcat) == 0) {
    $content = '
        <div>Новостей указанной категории нет</div>
    ';
} else {
    foreach($newsofcat as $key => $value) {
        $newsID = $value['id'];
        $newsTitle = $value['title'];
        $newsInform =  $value['inform'];
        $content .= "<div><a href='/news/{$newsID}'>{$newsTitle}</a></div>";         
    }
}


include_once("template.php");