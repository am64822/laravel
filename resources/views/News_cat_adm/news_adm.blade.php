{{-- управление новостями --}}


@extends('template')


{{-- приходят извне 
    $news (collection)
--}}

<?php
    $pageTitle = 'Управление новостями';
?>


@section('navPointer')
    {{ $pageTitle }}
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
    <div class='news_adm_header'>
        <a href="/newsadm/add">Добавить новость</a>
    </div>
    @forelse($news as $item)
        <div class='news_adm_news'>
            <div class='news_adm_news_id'>{{ $item->id }}</div>
            <div class='news_adm_news_cat'>{{ $item->cattitle }}</div>
            <div class='news_adm_news_title'>{{ $item->newstitle }}</div>
            <div class='news_adm_news_content'>{{ $item->content }}</div>
            {{-- <div class='news_adm_news_picture'>{{ $item->picture }}</div> --}}
            <div class='news_adm_news_status'>{{ $item->newsstatus }}</div>
            <div class='news_adm_news_timestamp'>{{ $item->newsupdat }}</div>
            <div class='news_adm_news_controls'><a href="/newsadm/edit/{{ $item->id }}">Изм.</a></div>
            <div class='news_adm_news_controls'><a href="/newsadm/del/{{ $item->id }}">X</a></div>
        </div>
    @empty
        <div class='crimson'>Новости отсутствуют</div>
    @endforelse
@endsection

 

