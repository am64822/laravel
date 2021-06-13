{{-- изменение отдельного источника --}}


@extends('template')


{{-- приходят извне 
    $source     -> single news
--}}

<?php
    $pageTitle = 'Изменение источника';
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
    @if (count($source) != 1)
        <div class='crimson'><br><br>Запрошенный источник не существует</div>
    @else    
        <form action="/srcadm/edit/{{ $source[0]->id }}" method='post'>
            @csrf
            <div style='display: inline-block; width: 200px'>Ссылка <span class='crimson'>*</span></div>
            <input type='hidden' name='linkInitial'value="{{ $source[0]->link }}">
            <input type='text' name='link' style='width: 200px' value="{{ $source[0]->link }}">
            <br>
            <div style='display: inline-block; width: 200px'>Описание <span class='crimson'>*</span></div>
            <textarea name='descr' style='width: 202px; resize: none'>{{ $source[0]->descr }}</textarea>
            <br>
            <div style='display: inline-block; width: 200px'>Статус</div>
            <select style='width: 208px' id='status' name='status'>
                <option value='published'
                @if ($source[0]->status == 'published')
                        selected
                    @endif                 
                >Опубликовано</option>
                <option value='hidden'
                @if ($source[0]->status == 'hidden')
                        selected
                @endif                 
                >Скрыто</option>
            </select> 
            <br>
            <br>
            <a href="/sourcadm"><button type='button' id='back' class='form_button'>Назад</button></a>
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

