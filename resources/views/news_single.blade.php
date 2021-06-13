@extends('template')

{{--  приходят извне 
    $id
    $news_single - массив с stdClass-ом из одной новости
--}}

<?php
    $pageTitle = 'Новость ' . $id;
    $user = Auth::user();
?>

@section('navPointer')
    &nbsp;
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
    @forelse($news_single as $value)
        <div><b>{{ $value->title }}</b><br>
        Дата изменения: {{ $value->updated_at }}<br><br>
        {{ $value->content }}
        </div>
        <?php
            $pageTitle .= $value->id;
        ?>
    @empty
        <div style='color: crimson'>Запрошенной новости c id = {{ $id }} не существует</div>
    @endforelse
@endsection
