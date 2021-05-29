@extends('template')

{{--  приходят извне 
    nothing
--}}

<?php
    $pageTitle = 'Заказ на выгрузку данных';
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
    <form action='/downlreq' method='post'>    
        @csrf
        <div style='display: inline-block; width: 200px'>Имя заказчика <span style='color: crimson'>*</span></div>
        <input type='text' name='userName' style='width: 200px' value="{{ old('userName') }}">
        <br>
        <div style='display: inline-block; width: 200px'>Телефон <span style='color: crimson'>*</span></div>
        <input type='text' name='phone' style='width: 200px' value="{{ old('phone') }}" placeholder='+0(000)0000000'>
        <br>
        <div style='display: inline-block; width: 200px'>E-Mail <span style='color: crimson'>*</span></div>
        <input type='email' name='email' style='width: 200px' value="{{ old('email') }}">
        <br>
        <div style='display: inline-block; width: 200px'>Что необходимо <span style='color: crimson'>*</span></div>
        <input type='text' name='content' style='width: 200px' value="{{ old('content') }}">
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
