<?php

// основная страница администрирования (промежуточная навигация)

/* приходят извне 
    nothing
*/
$header = 'Управление новостями (навигация)';
$menu = '
<nav>
    <a href="/">Главная</a>
    <a href="/cat">Категории новостей</a>
    <a href="/admnews">Управление новостями</a>
</nav>
';
$content = "<div>
    <br>
    <ul>
        <li><a href='/newsadd'>Создать новость</a></li>
    </ul>
</div>";
 

$ds = DIRECTORY_SEPARATOR;
include_once(realpath(resource_path() .  "{$ds}views{$ds}template.php"));