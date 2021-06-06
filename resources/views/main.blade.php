@extends('template')

{{-- приходят извне 
    nothing
--}}

<?php
    $pageTitle = 'Главная';
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
    <div style='width: 100%; text-align: center'>
        <br>
        <b>Добро пожаловать на сайт агрегатора новостей!</b>
    </div>
@endsection









