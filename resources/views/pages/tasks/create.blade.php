@extends('main.index')

@section('content')
    <section class="main_wrapper d-flex mt-4 gap-3">
        <div class="menu col-2">
            <a href="{{ route('task.index') }}"
                class="menu_point shadow-sm bg-white rounded p-3 text-decoration-none d-block">Задачи</a>
            <a href=""
                class="menu_point shadow-sm bg-white rounded p-3 mt-3 text-decoration-none w-100 d-block">Пользователи</a>
            <a href="{{ route('category.index') }}"
                class="menu_point shadow-sm bg-white rounded p-3 mt-3 text-decoration-none w-100 d-block">Категории</a>

        </div>
        <div class="content_wrapper col-10 shadow-sm bg-white rounded p-5">
            <form action="{{ route('task.store') }}" method="post">
                @csrf

                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Название</span>
                    <input type="text" class="form-control" aria-label="" aria-describedby="inputGroup-sizing-default"
                        value="" name="title">
                </div>

                <div class="form-floating mb-3">
                    <textarea name="description" class="form-control" placeholder="" id="floatingTextarea2" style="height: 100px">
                    </textarea>
                    <label for="floatingTextarea2">Описание</label>
                </div>

                <div class="form-floating w-25 mb-3">
                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example"
                        name="status">
                        <option value="Ожидание">Ожидание</option>
                        <option value="Готово">Готово</option>
                        <option value="В работе">В работе</option>
                    </select>
                    <label for="floatingSelect">Статус</label>
                </div>

                <div class="input-group w-25 mb-3">
                    <span class="input-group-text" id="basic-addon1">Id пользователя</span>
                    <input type="text" class="form-control" placeholder="user_id" aria-label="Username"
                        aria-describedby="basic-addon1" name="user_id">
                </div>

                <div class="form-floating w-25">
                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example"
                        name="category_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <label for="floatingSelect">Категория</label>
                </div>

                <button type="submit" class="btn btn-outline-success mt-5">Сохранить</button>
            </form>
        </div>
    </section>
@endsection
