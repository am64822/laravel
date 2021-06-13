{{-- управление новостями --}}


@extends('template')


{{-- приходят извне 
    $news (collection)
--}}

<?php
    $pageTitle = 'Управление новостями';
    $user = Auth::user();
    $script = "
    document.addEventListener('DOMContentLoaded', function(event) {
        let del_signs = document.getElementsByClassName('delete_sign');
        for (let item of del_signs) {
            item.addEventListener('click', function(e) {
                let id = item.dataset.id;
                let title = item.dataset.newstitle;
                let url = '/newsadm/del/' + id;
                if (confirm('Вы уверены, что хотите удалить новость ' + title + '?') == true) {
                    let formId = 'del_form_' + id;
                    let form = document.getElementById(formId);
                    form.submit();
                }
            });
        }
      });
    ";
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
    <div class='news_adm_header'>
        <a href="/newsadm/add">Добавить новость</a>
    </div>

    @if($news->count() > 0)
    <div class='news_adm_news bold'>
            <div class='news_adm_news_id'>ID</div>
            <div class='news_adm_news_cat'>Категория</div>
            <div class='news_adm_news_title'>Заголовок</div>
            <div class='news_adm_news_content'>Содержание</div>
            {{-- <div class='news_adm_news_picture'>{{ $item->picture }}</div> --}}
            <div class='news_adm_news_status'>Статус</div>
            <div class='news_adm_news_timestamp'>Обновлено</div>
            <div class='news_adm_news_controls'>Изм.</div>
            <div class='news_adm_news_controls'>Уд.</div>
        </div>
    @endif

    @forelse($news as $item)
        <div class='news_adm_news'>
            <div class='news_adm_news_id'>{{ $item->id }}</div>
            <div class='news_adm_news_cat'>{{ $item->cattitle }}</div>
            <div class='news_adm_news_title'>{{ $item->newstitle }}</div>
            <div class='news_adm_news_content'>{{ $item->content }}</div>
            {{-- <div class='news_adm_news_picture'>{{ $item->picture }}</div> --}}
            <div class='news_adm_news_status'>{{ $item->newsstatus }}</div>
            <div class='news_adm_news_timestamp'>{{ $item->newsupdat }}</div>
            <div class='news_adm_news_controls change'><a href="/newsadm/edit/{{ $item->id }}">Изм.</a></div>
            <div class="news_adm_news_controls">
                <span class='crimson delete_sign' id='del{{$item->id}}' data-id="{{ $item->id }}" data-newstitle="{{ $item->newstitle }}"><u>X</u></span>
                <form method="post" action="/newsadm/del/{{ $item->id }}" id="del_form_{{ $item->id }}" style='display: none'>
                    @csrf
                    @method('delete')
                    <input type="hidden" value="{{ $item->id }}">
                </form>
            </div>
        </div>
    @empty
        <div class='crimson'>Новости отсутствуют</div>
    @endforelse
@endsection

 

