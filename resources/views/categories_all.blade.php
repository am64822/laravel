@extends('template')

{{--  приходят извне 
    $categories
--}}

<?php
    $pageTitle = 'Категории новостей';
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
    @forelse($categories as $value)
        <div><a href="/newscat/{{ $value['id'] }}">{{ $value['title'] }}</a></div>       
    @empty
        <div>Нет категорий новостей</div>
    @endforelse
@endsection




