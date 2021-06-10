{{-- добавление отдельного источника --}}


@extends('template')


{{-- приходят извне 
    nothing
--}}

<?php
    $pageTitle = 'Добавление источника';
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
    <form action='/srcadm/add' method='post'>
        @csrf   
        <div style='display: inline-block; width: 200px'>Ссылка <span class='crimson'>*</span></div>
        <input type='text' name='link' style='width: 200px' value="{{ old('link') }}">
        <br>
        <div style='display: inline-block; width: 200px'>Описание <span class='crimson'>*</span></div>
        <textarea name='descr' style='width: 202px; resize: none'>{{ old('descr') }}</textarea>
        <br>
        <div style='display: inline-block; width: 200px'>Статус</div>
        <select style='width: 208px' id='selectedCategory' name='status'>
            <option value='published' selected>Опубликовано</option>
            <option value='hidden'>Скрыто</option>
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
@endsection

