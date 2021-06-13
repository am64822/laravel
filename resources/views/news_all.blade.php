@extends('template')

{{--  приходят извне
    $news
--}}

<?php
    $pageTitle = 'Все новости';
    $user = Auth::user();
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







