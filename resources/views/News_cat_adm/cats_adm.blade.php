{{-- управление категориями --}}


@extends('template')


{{-- приходят извне 
    $cats (collection)
--}}

<?php
    use App\Models\News;
    $pageTitle = 'Управление категориями';
    $script = "
    document.addEventListener('DOMContentLoaded', function(event) {
        let del_signs = document.getElementsByClassName('delete_sign');
        for (let item of del_signs) {
            item.addEventListener('click', function(e) {
                let id = item.dataset.id;
                let cattitle = item.dataset.cattitle;
                let url = '/catsadm/del/' + id;
                if (confirm('Вы уверены, что хотите удалить категорию ' + cattitle + '?') == true) {
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
    {{ $pageTitle }}. <br><span class='crimson'>Удалены могут быть только категории без новостей<span>
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
    <div class='cats_adm_header'>
        <a href="/catsadm/add">Добавить категорию</a>
    </div>
    @if($cats->count() > 0)
    <div class='cats_adm_cat bold'>
            <div class='cats_adm_cat_id'>ID</div>
            <div class='cats_adm_cat_source'>Источник</div>
            <div class='cats_adm_cat_title'>Категория</div>
            {{-- <div class='news_adm_news_picture'>{{ $item->picture }}</div> --}}
            <div class='cats_adm_cat_status'>Статус</div>
            <div class='cats_adm_cat_timestamp'>Обновлено</div>
            <div class='cats_adm_cat_controls'>Изм.</div>
            <div class='cats_adm_cat_controls'>Уд.</div>
        </div>
    @endif
    @forelse($cats as $item)
        <div class='cats_adm_cat'>
            <div class='cats_adm_cat_id'>{{ $item->id }}</div>
            <div class='cats_adm_cat_source'>{{ $item->srclink }}</div>
            <div class='cats_adm_cat_title'>{{ $item->cattitle }}</div>
            {{-- <div class='news_adm_news_picture'>{{ $item->picture }}</div> --}}
            <div class='cats_adm_cat_status'>{{ $item->cattatus }}</div>
            <div class='cats_adm_cat_timestamp'>{{ $item->catupdat }}</div>
            <div class='cats_adm_cat_controls'><a href="/catsadm/edit/{{ $item->id }}">Изм.</a></div>
            <div class='cats_adm_cat_controls'>
                @if((new News())->where('category_id', '=', $item->id)->count() == 0)
                <span class='crimson delete_sign' data-id="{{ $item->id }}" data-cattitle="{{ $item->cattitle }}"><u>X</u></span>
                    <form method="post" action="/catsadm/del/{{ $item->id }}" id="del_form_{{ $item->id }}" style='display: none'>
                        @csrf
                        @method('delete')
                        <input type="hidden" value="{{ $item->id }}">
                    </form>
                @else
                    &nbsp;
                @endif
            </div>
        </div>
    @empty
        <div class='crimson'>Категории отсутствуют</div>
    @endforelse
@endsection

 

