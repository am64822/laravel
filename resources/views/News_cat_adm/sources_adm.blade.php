{{-- управление источниками --}}


@extends('template')


{{-- приходят извне 
    $sources (collection)
--}}

<?php
    use App\Models\Category;
    $pageTitle = 'Управление источниками';
?>


@section('navPointer')
    {{ $pageTitle }}. <br><span class='crimson'>Удалены могут быть только те источники, к которым не привязаны категории<span>
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
    <div class='sources_adm_header'>
        <a href="/srcadm/add">Добавить источник</a>
    </div>
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
                    <a href="/srcadm/del/{{ $source->id }}">X</a>
                @else
                    &nbsp;
                @endif
            </div>
        </div>
    @empty
        <div class='crimson'>Источники отсутствуют</div>
    @endforelse
@endsection

 

