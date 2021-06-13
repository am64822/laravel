{{-- добавление отдельной категории --}}


@extends('template')


{{-- приходят извне 
    $src_list
--}}

<?php
    $pageTitle = 'Добавление категории';
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
    @if (count($src_list) == 0)
        <div class='crimson'><br><br>Для создания категории требуется хотя бы один источник новостей</div>
    @else    
        <form action='/catsadm/add' method='post'>
            @csrf
            <div style='display: inline-block; width: 200px'>Источник</div>
            <select style='width: 208px' id='selectedSource' name='source_id'>
            @foreach($src_list as $value)
                <option value="{{ $value->id }}">{{ $value->link }}</option>        
            @endforeach

            </select>       
            <br>    
            <div style='display: inline-block; width: 200px'>Наименование <span class='crimson'>*</span></div>
            <input type='text' name='title' style='width: 200px' value="{{ old('title') }}">
            <br>
            <div style='display: inline-block; width: 200px'>Статус</div>
            <select style='width: 208px' id='selectedStatus' name='status'>
                <option value='published' selected>Опубликовано</option>
                <option value='hidden'>Скрыто</option>
            </select> 
            <br>
            <br>
            <a href="/catsadm"><button type='button' id='back' class='form_button'>Назад</button></a>
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

