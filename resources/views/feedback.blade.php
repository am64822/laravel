@extends('template')

{{--  приходят извне 
    nothing
--}}

<?php
    $pageTitle = 'Обратная связь';
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
    <form action='/feedback' method='post'>    
        @csrf
        <div style='display: inline-block; width: 200px'>Имя пользователя <span style='color: crimson'>*</span></div>
        <input type='text' name='userName' style='width: 200px' value="{{ old('userName') }}">
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
