@extends('layouts.default')
@section('title', 'Site')
@section('content')
  <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}">Головна</a>
            </li>
            <li class="breadcrumb-item active">Історії</li>
        </ol>
    </nav>
  <div class="p-3 mb-3">
      <a type="button" href="{{url('stories/create')}}" class="btn btn-outline-warning btn-block">Додати історію</a>
  </div>

                @if(!empty($items))

                    @foreach($items as $item)

                        <div class="card">
                            <div class="card-header">
                                <strong>{{ $item->title }}</strong>
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                    <h5>{{$item->author}}</h5>
                                    <p>{{$item->content}}</p>
                                    <footer class="blockquote-footer">{{$item->created_at}}</footer>
                                </blockquote>
                            </div>
                        </div>
                    @endforeach
                @else

                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Записи відсутні</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                @endif

        {{ $items->links() }}

@endsection
