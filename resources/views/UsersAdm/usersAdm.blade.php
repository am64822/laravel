{{-- управление категориями --}}


@extends('template')


{{-- приходят извне 
    $users (collection)
--}}

<?php
    use App\Models\News;
    $pageTitle = 'Управление пользователями';
    $user = Auth::user();
    $script = "
    document.addEventListener('DOMContentLoaded', function(event) {
        let del_signs = document.getElementsByClassName('delete_sign');
        for (let item of del_signs) {
            item.addEventListener('click', function(e) {
                let id = item.dataset.id;
                let username = item.dataset.username;
                let url = '/catsadm/del/' + id;
                if (confirm('Вы уверены, что хотите удалить пользователя ' + username + '?') == true) {
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
    <div class='cats_adm_header'>
        &nbsp;
    </div>
    @if($users->count() > 0)
    <div class='users_adm_user bold'>
            <div class='users_adm_user_id'>ID</div>
            <div class='users_adm_user_name'>Имя польз.</div>
            <div class='users_adm_user_email'>E-Mail</div>
            {{-- <div class='news_adm_news_picture'>{{ $item->picture }}</div> --}}
            <div class='users_adm_user_isAdmin'>Админ</div>
            <div class='users_adm_user_timestamp'>Обновлено</div>
            <div class='users_adm_user_controls'>Изм.</div>
            <div class='users_adm_user_controls'>Уд.</div>
        </div>
    @endif
    @forelse($users as $item)
        <div class='users_adm_user'>
            <div class='users_adm_user_id'>{{ $item->id }}</div>
            <div class='users_adm_user_name'>{{ $item->name }}</div>
            <div class='users_adm_user_email'>{{ $item->email }}</div>
            {{-- <div class='news_adm_news_picture'>{{ $item->picture }}</div> --}}
            <div class='users_adm_user_isAdmin'>
                @if($item->is_admin == true) 
                    Да
                @else
                    &nbsp;
                @endif
            </div>
            <div class='users_adm_user_timestamp'>{{ $item->updated_at }}</div>
            <div class='users_adm_user_controls'><a href="/usersadm/edit/{{ $item->id }}">Изм.</a></div>
            <div class='users_adm_user_controls'>
                <span class='crimson delete_sign' data-id="{{ $item->id }}" data-username="{{ $item->name }}"><u>X</u></span>
                <form method="post" action="/usersadm/del/{{ $item->id }}" id="del_form_{{ $item->id }}" style='display: none'>
                    @csrf
                    @method('delete')
                    <input type="hidden" value="{{ $item->id }}">
                </form>
            </div>
        </div>
    @empty
        <div class='crimson'>Пользователи отсутствуют</div>
    @endforelse
@endsection

 

