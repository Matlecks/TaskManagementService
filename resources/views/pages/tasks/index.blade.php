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
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <a href="{{ route('task.create') }}" class="btn btn-outline-success">Создать задачу</a>
            </div>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Название</th>
                        <th scope="col">Описание</th>
                        <th scope="col">Статус</th>
                        <th scope="col">Пользователь</th>
                        <th scope="col">Категория</th>
                        <th scope="col">Создан</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <th scope="row">{{ $task->id }}</th>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>{{ $task->status }}</td>
                            <td>{{ $task->user_id }}</td>
                            <td>{{ $task->category->name }}</td>
                            <td>{{ $task->created_at }}</td>
                            <td>
                                <button type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                    style="backgroud:none; border:none;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#6C757DFF"
                                        class="bi bi-list" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z">
                                        </path>
                                    </svg>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item"
                                            href="{{ route('task.edit', $id = $task->id) }}">Изменить</a></li>
                                    <li>
                                        <form action="{{ route('task.destroy', $id = $task->id) }}" method="POST"
                                            class="dropdown-item">
                                            @csrf
                                            <button type="submit"
                                                style="border:none; background: none; padding: 0px;">Удалить</button>
                                        </form>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
