{{-- управление источниками --}}


@extends('template')


{{-- приходят извне 
    $sources (collection)
--}}

<?php
    use App\Models\Category;
    $pageTitle = 'Управление источниками';
    $user = Auth::user();
    $script = "
    document.addEventListener('DOMContentLoaded', function(event) {
        let del_signs = document.getElementsByClassName('delete_sign');
        for (let item of del_signs) {
            item.addEventListener('click', function(e) {
                let id = item.dataset.id;
                let link = item.dataset.link;
                let url = '/srcadm/del/' + id;
                if (confirm('Вы уверены, что хотите удалить источник ' + link + '?') == true) {
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
    {{ $pageTitle }}. <br><span class='crimson'>Удалены могут быть только те источники, к которым не привязаны категории<span>
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
    <div class='sources_adm_header'>
        <a href="/srcadm/add">Добавить источник</a>
    </div>

    @if($sources->count() > 0)
    <div class='sources_adm_source bold'>
            <div class='sources_adm_source_id'>ID</div>
            <div class='sources_adm_source_link'>Адрес</div>
            <div class='sources_adm_source_descr'>Описание</div>
            <div class='sources_adm_source_status'>Статус</div>
            <div class='sources_adm_source_timestamp'>Обновлено</div>
            <div class='sources_adm_source_controls'>Изм.</div>
            <div class='sources_adm_source_controls'>Уд.</div>
        </div>
    @endif

    @forelse($sources as $source)
        <div class='sources_adm_source'>
            <div class='sources_adm_source_id'>{{ $source->id }}</div>
            <div class='sources_adm_source_link'>{{ $source->link }}</div>
            <div class='sources_adm_source_descr'>{{ $source->descr }}</div>
            <div class='sources_adm_source_status'>{{ $source->status }}</div>
            <div class='sources_adm_source_timestamp'>{{ $source->updated_at }}</div>
            <div class='sources_adm_source_controls'><a href="/srcadm/edit/{{ $source->id }}">Изм.</a></div>
            <div class='sources_adm_source_controls'>
                @if((new Category())->where('source_id', '=', $source->id)->count() == 0)
                    <span class='crimson delete_sign' data-id="{{ $source->id }}" data-link="{{ $source->link }}"><u>X</u></span>
                    <form method="post" action="/srcadm/del/{{ $source->id }}" id="del_form_{{ $source->id }}" style='display: none'>
                        @csrf
                        @method('delete')
                        <input type="hidden" value="{{ $source->id }}">
                    </form>
                @else
                    &nbsp;
                @endif
            </div>
        </div>
    @empty
        <div class='crimson'>Источники отсутствуют</div>
    @endforelse
@endsection

 

