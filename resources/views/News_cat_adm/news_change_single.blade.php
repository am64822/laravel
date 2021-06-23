{{-- изменение отдельной новости --}}


@extends('template')


{{-- приходят извне 
    $cats_list
    $news     -> single news
--}}

<?php
    $pageTitle = 'Изменение новости';
    $user = Auth::user();
    $ds = DIRECTORY_SEPARATOR;
    $CKEditorPath =  URL::asset('js' . $ds . 'ckeditor' . $ds . 'ckeditor.js');
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
    @if (count($cats_list) == 0)
        <div class='crimson'><br><br>Для изменениния новости требуется хотя бы одна категория новостей</div>
    @elseif (count($news) != 1)
        <div class='crimson'><br><br>Запрошенная новость не существует</div>
    @else    
        <form action="/newsadm/edit/{{ $news[0]->id }}" method='post' enctype='multipart/form-data'>
            @csrf
            <div style='display: inline-block; width: 200px'>Категория</div>
            <select style='width: 408px' id='selectedCategory' name='category_id'>
            @foreach($cats_list as $value)                
                <option value="{{ $value->id }}"
                @if ($news[0]->category_id == $value->id)
                    selected
                @endif                    
                >{{ $value->title }}</option>          
            @endforeach
            </select>       
            <br>    
            <div style='display: inline-block; width: 200px'>Заголовок <span class='crimson'>*</span></div>
            <input type='text' name='title' style='width: 400px' value="{{ $news[0]->title }}" id='title'>
            <br>
            <div style='display: inline-block; width: 200px'>Содержание <span class='crimson'>*</span></div>
            <textarea name='content' id='content' style='width: 402px; resize: none'>{!! $news[0]->content !!}</textarea>
            <br>
            <div style='display: inline-block; width: 200px'>Статус</div>
            <select style='width: 408px' id='selectedStatus' name='status'>
                <option value='draft'
                    @if ($news[0]->status == 'draft')
                        selected
                    @endif 
                >Проект</option>
                <option value='published'
                @if ($news[0]->status == 'published')
                        selected
                    @endif                 
                >Опубликовано</option>
                <option value='hidden'
                @if ($news[0]->status == 'hidden')
                        selected
                @endif                 
                >Скрыто</option>
            </select> 
            <br>
            <br>
            <a href="/newsadm"><button type='button' id='back' class='form_button'>Назад</button></a>
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
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function(event) {
            var options = {
            //filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            //filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            //filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',
            filebrowserUploadMethod: 'form'
            };           
            CKEDITOR.replace('content', options);

            /*(CKEDITOR.replace( 'content', {
                filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });*/
        });
        
    </script>

@endsection

