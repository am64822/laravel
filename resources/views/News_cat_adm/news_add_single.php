<?php

// добавление отдельной новости

/* приходят извне 
    nothing
*/

// пока нет модели - вот таким кривым способом получение списка категорий (чтобы можно было использовать только существующую категорию)
use App\Http\Controllers\CategoriesController;
$cats_list = (new CategoriesController())->allAsArray();
//$cats_list = array(); // пустой массив для отладки

$header = 'Добавить новость';
$menu = '
<nav>
    <a href="/">Главная</a>
    <a href="/cat">Категории новостей</a>
    <a href="/admnews">Управление новостями</a>
</nav>
';

if (count($cats_list) == 0) {
    $content = "<div style='color: crimson'><br><br>Для создания новости требуется хотя бы одна категория новостей</div>";
} else {
    $cats_selector = "<select style='width: 208px' id='selectedCategory'>";
    foreach($cats_list as $key => $value) {
        $catID = $value['id'];
        $catTitle = $value['title'];  
        $cats_selector .= "<option value='{$catID}'>({$catID}) {$catTitle}</option>";
    }
    $cats_selector .= "</select>";


    // должна быть форма, но пока не совсем понятно, как ее интегрировать. Поэтому будет div
    $content = "<div>
        <br>
        <div style='display: inline-block; width: 200px'>Номер категории</div>{$cats_selector}<br>    
        <div style='display: inline-block; width: 200px'>Заголовок</div><input type='text' name='header' style='width: 200px'><br>
        <div style='display: inline-block; width: 200px'>Содержание</div><textarea name='body' style='width: 202px; resize: none'></textarea><br>
        <br>
        <button id='submit'>Сохранить</button>
    </div>";

    // дополнительный js-скрипт для страницы
    $script = "
        document.getElementById('submit').addEventListener('click', (e) => {
            alert('Создание новости в категории ' + document.getElementById('selectedCategory').value + 
            '. После реализации реального добавления новости здесь должен быть переход на страницу с новостями данной категории.');
        });
    ";

}

$ds = DIRECTORY_SEPARATOR;
include_once(realpath(resource_path() .  "{$ds}views{$ds}template.php"));