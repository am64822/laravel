@extends('template')

{{--  приходят извне 
    $cat_id
    $newsofcat
--}}

<?php
    $pageTitle = 'Новости категории ' . $cat_id;
?>


@section('navPointer')
    {{ $pageTitle }}
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
    @forelse($newsofcat as $value)
        <div><a href="/news/{{ $value['id'] }}">{{ $value['title'] }}</a></div>       
    @empty
        <div style='color: crimson'>Новостей указанной категории нет</div>
    @endforelse
@endsection




