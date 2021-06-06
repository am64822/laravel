{{-- изменение отдельного источника --}}


@extends('template')


{{-- приходят извне 
    $source     -> single news
--}}

<?php
    $pageTitle = 'Изменение источника';
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
    @if (count($source) != 1)
        <div class='crimson'><br><br>Запрошенный источник не существует</div>
    @else    
        <form action="/srcadm/edit/{{ $source[0]->id }}" method='post'>
            @csrf
            <div style='display: inline-block; width: 200px'>Ссылка <span class='crimson'>*</span></div>
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
            <button type='submit' id='submit'>Сохранить</button>
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

