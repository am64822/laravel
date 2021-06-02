{{-- добавление отдельной новости --}}


@extends('template')


{{-- приходят извне 
    nothing
--}}

<?php
    $pageTitle = 'Добавить новость';
    use Illuminate\Support\Facades\DB;
    $cats_list = DB::table('categories')->get();
?>


@section('navPointer')
    {{ $pageTitle }}
@endsection


@section('menu')
    <nav>
        <a href="/">Главная</a>
        <a href="/cat">Категории новостей</a>
        <a href="/admnews">Управление новостями</a>
        <a href="/downlreq">Заказ на выгрузку</a>
        <a href="/feedback">Обратная связь</a>
    </nav>
@endsection


@section('content')
    {{-- div будет изменен на форму после изучения записи в БД через laravel --}}
    @if (count($cats_list) == 0)
        <div style='color: crimson'><br><br>Для создания новости требуется хотя бы одна категория новостей</div>
    @else    
        <div>
            <div style='display: inline-block; width: 200px'>Номер категории</div>
            <select style='width: 208px' id='selectedCategory'>
            @foreach($cats_list as $value)
                <option value="{{ $value->title }}">{{ $value->title }}</option>        
            @endforeach
            </select>       
            <br>    
            <div style='display: inline-block; width: 200px'>Заголовок</div>
            <input type='text' name='header' style='width: 200px'>
            <br>
            <div style='display: inline-block; width: 200px'>Содержание</div>
            <textarea name='body' style='width: 202px; resize: none'></textarea>
            <br>
            <br>
            <button id='submit'>Сохранить</button>
        </div>
        <?php
            // дополнительный js-скрипт для страницы
            $script = "
                document.getElementById('submit').addEventListener('click', (e) => {
                    alert('Создание новости в категории ' + document.getElementById('selectedCategory').value + 
                    '. После реализации реального добавления новости в БД здесь должен быть переход на страницу с новостями данной категории.');
                });
            ";
        ?>
    @endif
@endsection

