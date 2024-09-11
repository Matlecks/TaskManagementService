@extends('main.index')

@section('content')
    <section class="main_wrapper d-flex mt-4 gap-3">
        <div class="menu col-2">
            <a href="{{ route('task.index') }}"
                class="menu_point shadow-sm bg-white rounded p-3 text-decoration-none w-100 d-block">Задачи</a>
            <a href="{{ route('user.index') }}"
                class="menu_point shadow-sm bg-white rounded p-3 mt-3 text-decoration-none w-100 d-block">Пользователи</a>
            <a href="{{ route('category.index') }}"
                class="menu_point shadow-sm bg-white rounded p-3 mt-3 text-decoration-none w-100 d-block">Категории</a>

        </div>
        <div class="content_wrapper col-10 shadow-sm bg-white rounded p-5">

            <div class="button_group d-flex justify-content-end mb-4">

            </div>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Имя</th>
                        <th scope="col">Почта</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
