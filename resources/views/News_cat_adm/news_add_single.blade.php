{{-- добавление отдельной новости --}}


@extends('template')


{{-- приходят извне 
    $cats_list
--}}

<?php
    $pageTitle = 'Добавление новости';
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
    @if (count($cats_list) == 0)
        <div class='crimson'><br><br>Для создания новости требуется хотя бы одна категория новостей</div>
    @else    
        <form action='/newsadm/add' method='post'>
            @csrf
            <div style='display: inline-block; width: 200px'>Категория</div>
            <select style='width: 208px' id='selectedCategory' name='category_id'>
            @foreach($cats_list as $value)
                <option value="{{ $value->id }}">{{ $value->title }}</option>        
            @endforeach
            </select>       
            <br>    
            <div style='display: inline-block; width: 200px'>Заголовок <span class='crimson'>*</span></div>
            <input type='text' name='title' style='width: 200px' value="{{ old('title') }}">
            <br>
            <div style='display: inline-block; width: 200px'>Содержание <span class='crimson'>*</span></div>
            <textarea name='content' style='width: 202px; resize: none'>{{ old('content') }}</textarea>
            <br>
            <div style='display: inline-block; width: 200px'>Статус</div>
            <select style='width: 208px' id='selectedCategory' name='status'>
                <option value='draft' selected>Проект</option>
                <option value='published'>Опубликовано</option>
                <option value='hidden'>Скрыто</option>
            </select> 
            <br>
            <br>
            <a href="/newsadm"><button type='button' id='back' class='form_button'>Назад</button></a>
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
    @endif
@endsection

