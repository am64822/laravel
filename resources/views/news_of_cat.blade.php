@extends('template')

{{--  приходят извне
    $cat_id
    $cat_exists
    $cat_title
    $newsofcat
--}}

<?php
    if ($cat_exists == true) {
        $pageTitle = 'Новости категории "' . $cat_title . '"';
    } else {
        $pageTitle = 'Новости категории ' . $cat_id;
    }
?>




@section('navPointer')
    @if ($cat_exists == true) 
        {{ $pageTitle }}
    @else
        Новости категории с id = {{ $cat_id }}
    @endif    
@endsection


@section('content')
    @if ($cat_exists == true) 
        @forelse($newsofcat as $value)
            <div><a href="/news/{{ $value->id }}">{{ $value->title }}</a></div>       
        @empty
            <div style='color: crimson'>Новостей указанной категории нет</div>
        @endforelse
    @else
        <div style='color: crimson'><span style='color: crimson'>Запрошенной категории новостей не существует</span></div>
    @endif
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







