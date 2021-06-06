@extends('template')

{{--  приходят извне 
    $categories
--}}

<?php
    $pageTitle = 'Новости по категориям';
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
    @forelse($categories as $value)
        <div><a href="/newscat/{{ $value->id }}">{{ $value->title }}</a></div>       
    @empty
        <div>Нет категорий новостей</div>
    @endforelse
@endsection




