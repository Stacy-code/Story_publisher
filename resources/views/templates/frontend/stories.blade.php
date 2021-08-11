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

    <div class="container-fluid">
        <div id="rate-msg" class="alert alert-success alert-dismissible fade " role="alert">

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span>&times;</span>
            </button>
        </div>
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
                        <a type="button" href="{{url('/stories/rate')}}" data-type="like_btn"
                           class="btn btn-outline-light" data-id="{{$item->id}}">
                            <img src="/public/icons/like.png" alt="">
                            <p> {{$item->like_count}}</p>
                        </a>
                        <a type="button" href="{{url('/stories/rate')}}" data-type="dislike_btn"
                           class="btn btn-outline-light" data-id="{{$item->id}}">
                            <img src="/public/icons/dislike.png" alt="">
                            <p> {{$item->dislike_count}} </p>
                        </a>
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

@push('scripts')
    <script>
        $(document).ready(function () {
            $(document).on('click', '[data-type="like_btn"]', function (e) {
                e.preventDefault();
                setVote('like', {
                    button: $(this),
                    id: $(this).data('id')
                });
            });
            $(document).on('click', '[data-type="dislike_btn"]', function (e) {
                e.preventDefault();
                setVote('dislike', {
                    button: $(this),
                    id: $(this).data('id')
                });
            });

        });

        function setVote(type, options) {
            // получение данных из полей
            var url = options.button.attr('href');
            if (typeof url === 'string' && url.length > 0) {

                $.ajax({
                    // метод отправки
                    type: "POST",
                    // путь до скрипта-обработчика
                    url: url,
                    // какие данные будут переданы
                    data: {
                        'id': options.id,
                        'button_type': type,
                        "_token": "{{ csrf_token() }}"
                    },
                    // тип передачи данных
                    dataType: "json",
                    // действие, при ответе с сервера
                    success: function (response) {
                        if (typeof response.msg === 'string' && response.msg.length > 0) {

                            var alertEl = $(document).find('#rate-msg');

                            if (alertEl.length > 0) {
                                alertEl.text(response.msg);
                                alertEl.addClass('show');
                            }


                            options.button.find('p').text(response.count);

                        }

                    }

                });
            } else {
                throw new Error('Attribute href must be set!');
            }
        }
    </script>
@endpush

