@extends('main.index')

@section('content')
    <section class="main_wrapper d-flex mt-4 gap-3">
        <div class="menu col-2">
            <a href="{{ route('category.index') }}"
                class="menu_point shadow-sm bg-white rounded p-3 text-decoration-none d-block">Задачи</a>
            <a href=""
                class="menu_point shadow-sm bg-white rounded p-3 mt-3 text-decoration-none w-100 d-block">Пользователи</a>
            <a href=""
                class="menu_point shadow-sm bg-white rounded p-3 mt-3 text-decoration-none w-100 d-block">Категории</a>

        </div>
        <div class="content_wrapper col-10 shadow-sm bg-white rounded p-5">
            <form action="{{ route('category.store') }}" method="post">
                @csrf

                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Название</span>
                    <input type="text" class="form-control" aria-label="" aria-describedby="inputGroup-sizing-default"
                        value="" name="name">
                </div>

                <button type="submit" class="btn btn-outline-success mt-5">Сохранить</button>
            </form>
        </div>
    </section>
@endsection
