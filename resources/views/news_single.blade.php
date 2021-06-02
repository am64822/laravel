@extends('template')

{{--  приходят извне 
    $news_single - массив с stdClass-ом из одной новости
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
        <a href="/downlreq">Заказ на выгрузку</a>
        <a href="/feedback">Обратная связь</a>
    </nav>
@endsection


@section('content')
    @forelse($news_single as $value)
        <div><b>{{ $value->title }}</b><br>{{ $value->content }}</div>
        <?php
            $pageTitle .= $value->id;
        ?>
    @empty
        <div style='color: crimson'>Запрошенной новости нет</div>
    @endforelse
@endsection
