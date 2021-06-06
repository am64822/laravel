{{-- основная страница администрирования (промежуточная навигация) --}}


@extends('template')


{{-- приходят извне 
    nothing
--}}

<?php
    $pageTitle = 'Управление (навигация)';
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
    <div>
        <ul>
            <li><a href='/newsadm'>Управление новостями</a></li>
            <li><a href='/catsadm'>Управление категориями</a></li>
            <li><a href='/sourcadm'>Управление источниками</a></li>
        </ul>
    </div>
@endsection

 

