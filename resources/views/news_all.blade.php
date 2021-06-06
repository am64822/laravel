@extends('template')

{{--  приходят извне
    $news
--}}

<?php
    $pageTitle = 'Все новости';
?>




@section('navPointer')
    {{ $pageTitle }} 
@endsection


@section('content')

        @forelse($news as $value)
            <div class='news'>
                <div class='news_title'><a href="/news/{{ $value->id }}">{{ $value->title }}</a></div>
            </div>
        @empty
            <div style='color: crimson'>Новостей нет</div>

        @endforelse

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







