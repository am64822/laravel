{{-- изменение атрибутов пользователя --}}


@extends('template')


{{-- приходят извне 
    $userToChange     -> single news
--}}

<?php
    $pageTitle = 'Изменение атрибуов пользователя';
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
    <form action="/usersadm/edit/{{ $userToChange[0]->id }}" method='post'>
        @csrf    
        <div style='display: inline-block; width: 200px'>Имя пользователя<span class='crimson'> *</span></div>
        <input type='hidden' name='userNameInitial'value="{{ $userToChange[0]->name }}">
        <input type='text' name='userName' style='width: 200px' value="{{ $userToChange[0]->name }}">
        <br>
        <div style='display: inline-block; width: 200px'>E-Mail<span class='crimson'> *</span></div>
        <input type='hidden' name='emailInitial'value="{{ $userToChange[0]->email }}">
        <input type='text' name='email' style='width: 200px' value="{{ $userToChange[0]->email }}">
        <br>        
        <div style='display: inline-block; width: 200px'>Админ<span class='crimson'> *</span></div>
        <select style='width: 208px' id='selectedAdminStatus' name='is_admin'>
            <option value='1'
            @if ($userToChange[0]->is_admin == 1)
                    selected
                @endif                 
            >Да</option>
            <option value='0'
            @if ($userToChange[0]->is_admin == 0)
                    selected
            @endif                 
            >Нет</option>
        </select> 
        <br>
        <br>
        <a href="/usersadm"><button type='button' id='back' class='form_button'>Назад</button></a>
        <button type='submit' id='submit' class='form_button form_button_marg_left'>Сохранить</button>
    </form>
    @if($errors->any())
        <br>
        @foreach($errors->all() as $error)
            <div style='color: crimson'>
                {{ $error }}
            </div>
        @endforeach
    @endif
@endsection

