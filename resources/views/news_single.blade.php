@extends('template')

{{--  приходят извне 
    $news_single - массив с массивом новостей из одной новости
--}}

<?php
    $pageTitle = 'Новость ';
?>

@section('navPointer')
    &nbsp;
@endsection


@section('menu')
    <nav>
        <a href="/">Главная</a>
        <a href="/cat">Категории новостей</a>
        <a href="/admnews">Управление новостями</a>
    </nav>
@endsection


@section('content')
    @forelse($news_single as $value)
        <div><b>{{ $value['title'] }}</b><br>{{ $value['inform'] }}</div>
        <?php
            $pageTitle .= $value['id'];
        ?>
    @empty
        <div style='color: crimson'>Запрошенной новости нет</div>
    @endforelse
@endsection
