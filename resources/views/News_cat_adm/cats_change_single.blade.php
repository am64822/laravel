{{-- изменение отдельной категории --}}


@extends('template')


{{-- приходят извне 
    $src_list
    $cat     -> single news
--}}

<?php
    $pageTitle = 'Изменение категории';
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
        <div class='crimson'><br><br>Для изменениния категории требуется хотя бы один источник новостей</div>
    @elseif (count($cat) != 1)
        <div class='crimson'><br><br>Запрошенная категория не существует</div>
    @else    
        <form action="/catsadm/edit/{{ $cat[0]->id }}" method='post'>
            @csrf
            <div style='display: inline-block; width: 200px'>Источник</div>
            <select style='width: 208px' id='selectedSource' name='source_id'>
            @foreach($src_list as $value)                
                <option value="{{ $value->id }}"
                @if ($cat[0]->source_id == $value->id)
                    selected
                @endif                    
                >{{ $value->link }}</option>          
            @endforeach
            </select>       
            <br>    
            <div style='display: inline-block; width: 200px'>Наименование <span class='crimson'>*</span></div>
            <input type='hidden' name='titleInitial'value="{{ $cat[0]->title }}">
            <input type='text' name='title' style='width: 200px' value="{{ $cat[0]->title }}">
            <br>
            <div style='display: inline-block; width: 200px'>Статус</div>
            <select style='width: 208px' id='selectedStatus' name='status'>
                <option value='published'
                @if ($cat[0]->status == 'published')
                        selected
                    @endif                 
                >Опубликовано</option>
                <option value='hidden'
                @if ($cat[0]->status == 'hidden')
                        selected
                @endif                 
                >Скрыто</option>
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

