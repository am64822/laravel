{{-- добавление отдельной категории --}}


@extends('template')


{{-- приходят извне 
    $src_list
--}}

<?php
    $pageTitle = 'Добавление категории';
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

