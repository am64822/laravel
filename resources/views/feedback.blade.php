@extends('template')

{{--  приходят извне 
    nothing
--}}

<?php
    $pageTitle = 'Обратная связь';
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
    <form action='/feedback' method='post'>    
        @csrf
        <div style='display: inline-block; width: 200px'>Имя пользователя <span style='color: crimson'></span></div>
        <input type='text' name='userName' style='width: 200px' value="{{$user->name}}" disabled>
        <br>
        <div style='display: inline-block; width: 200px'>Комментарий / отзыв <span style='color: crimson'>*</span></div>
        <textarea name='feedbackTxt' style='width: 202px; resize: none'>{{ old('feedbackTxt') }}</textarea>
        <br>
        <br>
        <button type='submit' id='submit'>Отправить</button>
    </form>
    @if (!is_null($messageToUser)) 
        <div style='color: green; margin-top: 20px'>
            {{ $messageToUser }}
        </div>
    @else
        @if($errors->any())
            <br>
            @foreach($errors->all() as $error)
                <div style='color: crimson'>
                    {{ $error }}
                </div>
            @endforeach
        @endif 
    @endif
@endsection
