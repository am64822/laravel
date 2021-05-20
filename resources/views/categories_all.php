<?php

/* приходят извне 
$categories
*/

$header = 'Категории новостей';
$menu = '
<nav>
    <a href="/">Главная</a>
    <a href="/cat">Категории новостей</a>
    <a href="/admnews">Управление новостями</a>
</nav>
';
$content = '';
 
if (count($categories) == 0) {
    $content = '
        <div>Нет категорий новостей</div>
    ';
} else {
    foreach($categories as $key => $value) {
        $catID = $value['id'];
        $catTitle = $value['title']; 
        $content .= "<div><a href='/newscat/{$catID}'>{$catTitle}</a></div>";       
    }
}

include_once("template.php");