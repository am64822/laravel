{{-- управление категориями --}}


@extends('template')


{{-- приходят извне 
    $cats (collection)
--}}

<?php
    use App\Models\News;
    $pageTitle = 'Управление категориями';
?>


@section('navPointer')
    {{ $pageTitle }}. <br><span class='crimson'>Удалены могут быть только категории без новостей<span>
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
        <a href="/catsadm/add">Добавить категорию</a>
    </div>
    @forelse($cats as $item)
        <div class='news_adm_news'>
            <div class='news_adm_news_id'>{{ $item->id }}</div>
            <div class='news_adm_news_cat'>{{ $item->srclink }}</div>
            <div class='news_adm_news_title'>{{ $item->cattitle }}</div>
            {{-- <div class='news_adm_news_picture'>{{ $item->picture }}</div> --}}
            <div class='news_adm_news_status'>{{ $item->cattatus }}</div>
            <div class='news_adm_news_timestamp'>{{ $item->catupdat }}</div>
            <div class='news_adm_news_controls'><a href="/catsadm/edit/{{ $item->id }}">Изм.</a></div>
            <div class='news_adm_news_controls'>
                @if((new News())->where('category_id', '=', $item->id)->count() == 0)
                    <a href="/catsadm/del/{{ $item->id }}">X</a>
                @else
                    &nbsp;
                @endif
            </div>
        </div>
    @empty
        <div class='crimson'>Категории отсутствуют</div>
    @endforelse
@endsection

 

