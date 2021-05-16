@extends('layouts.default')
@section('title', 'Створити запис')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}">Головна</a>
            </li>
            <li class="breadcrumb-item active">Список записів</li>
        </ol>
    </nav>
    <div class="container-fluid mt-3">
        <div class="row">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Автор</th>
                        <th scope="col">Заголовок</th>
                        <th scope="col">Назва</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($items))
                        @foreach($items as $item)
                            <tr>
                                <th scope="row">{{ $item->id }}</th>
                                <td>{{ $item->author }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->content }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr aria-colspan="4">
                            <td colspan="4">Записи відсутні...</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
