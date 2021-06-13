{{-- основная страница администрирования (промежуточная навигация) --}}


@extends('template')


{{-- приходят извне 
    nothing
--}}

<?php
    $pageTitle = 'Управление (навигация)';
    $user = Auth::user();
?>


@section('navPointer')
    {{ $pageTitle }}
@endsection


@section('menu')
    <nav class='nav'>
        <a href="/" class='navReg'>Главная</a>
        <a href="/newsall" class='navReg'>Все новости</a>  
        <a href="/cat" class='navReg'>Новости по категориям</a>
        @if (isset($user))
            @if ($user->is_admin == true)
                <a href="/adm" class='navReg'>Управление</a>
            @endif
            <a href="/downlreq" class='navReg'>Заказ на выгрузку</a>
            <a href="/feedback" class='navReg'>Обратная связь</a>
        @endif    
        <div class='navLast'>
        @if (!isset($user))
            <a href="/login">Войти</a>
            <a href="/register" class='navLastLast'>Зарегистрироваться</a>
        @else
            <span>Вы вошли как {{$user->name}}</span>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class='navLastLast'>Выйти
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class='dontDisplay'>
                @csrf
            </form>
        @endif
        </div>
    </nav>
@endsection


@section('content')
    <div>
        <ul>
            <li><a href='/newsadm'>Управление новостями</a></li>
            <li><a href='/catsadm'>Управление категориями</a></li>
            <li><a href='/sourcadm'>Управление источниками</a></li>
            <li><a href='/usersadm'>Управление пользователями</a></li>
        </ul>
    </div>
@endsection

 

