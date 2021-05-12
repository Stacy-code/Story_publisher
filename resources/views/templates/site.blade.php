@extends('layouts.default')
@section('title', 'Site')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}">Головна</a>
            </li>
            <li class="breadcrumb-item active">Створити запис</li>
        </ol>
    </nav>
    <div class="container-fluid mt-3">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('site') }}">
            @csrf

            <div class="form-group">
                <label for="title">Заголовок</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label for="author">Автор</label>
                <input type="text" class="form-control" id="author" name="author" value="{{ old('author') }}">
            </div>
            <div class="form-group">
                <label for="content">Контент</label>
                <textarea class="form-control" name="content" id="content">{{ old('content') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
@endSection
