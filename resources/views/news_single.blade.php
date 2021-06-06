@extends('template')

{{--  приходят извне 
    $id
    $news_single - массив с stdClass-ом из одной новости
--}}

<?php
    $pageTitle = 'Новость ' . $id;
?>

@section('navPointer')
    &nbsp;
@endsection


@section('menu')
    <nav>
        <a href="/">Главная</a>
        <a href="/newsall">Все новости</a>        
        <a href="/cat">Новости по категориям</a>
        <a href="/adm">Управление</a>
        <a href="/downlreq">Заказ на выгрузку</a>
        <a href="/feedback">Обратная связь</a>
    </nav>
@endsection


@section('content')
    @forelse($news_single as $value)
        <div><b>{{ $value->title }}</b><br>
        Дата изменения: {{ $value->updated_at }}<br><br>
        {{ $value->content }}
        </div>
        <?php
            $pageTitle .= $value->id;
        ?>
    @empty
        <div style='color: crimson'>Запрошенной новости c id = {{ $id }} не существует</div>
    @endforelse
@endsection
