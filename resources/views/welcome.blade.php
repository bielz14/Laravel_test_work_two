<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/consumer.js') }}"></script>
    <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest

                    @else

                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                        @if (Session::has('error'))
                            <div class="alert alert-danger" style="margin-right: 8%; width: 50%">
                                @php
                                    $value = \Session::get('error');
                                @endphp
                                {{ $value }};
                            </div>
                        @elseif(Session::has('success'))
                            <div class="alert alert-success" style="margin-right: 8%; width: 50%">
                                @php
                                    $value = \Session::get('success');
                                @endphp
                                {{ $value }};
                            </div>
                        @endif
                <div class="col-md-8">
                    @guest
                        <div class="card card-default">
                            <div class="card-header">Login</div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="login" class="col-md-4 col-form-label text-md-right">Login</label>

                                        <div class="col-md-6">
                                            <input id="login" type="text" class="form-control{{ $errors->has('login') ? ' is-invalid' : '' }}" name="login" value="{{ old('login') }}" required autofocus>

                                            @if ($errors->has('login'))
                                                <span class="invalid-feedback">
                                            <strong>{{ $errors->first('login') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                Login
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="nav-bar">
                            <div class="n_b_1">
                                <b><label>Login:</label></b>
                                <span class="username-item" style="color: indigo">{{ Auth::user()->login }}</span>
                            </div>
                            <div class="n_b_2" style="float: right; margin-top: -3.5%">
                                <a class="logout-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </div>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                        <table class="table table-bordered">
                            @if (count($consumer) > 0)
                                <tr>
                                    <th>No</th>
                                    <th>ConsumerId</th>
                                    <th>Login</th>
                                    <th>Email</th>
                                    <th>Group</th>
                                    <th width="280px">Action</th>
                                </tr>
                            @else
                                @guest
                                @else
                                    <span style="color: #c82333;">No ads!</span>
                                @endguest
                            @endif
                            @foreach ($consumer as $item)
                                <tr data-consumer_id="{{ $item->consumerId}}">
                                    <td>{{ ++$i }}</td>
                                    <td>
                                        {{ $item->consumerId}}
                                    </td>
                                    <td>
                                        {{ $item->login}}
                                    </td>
                                    <td>
                                        {{ $item->email}}
                                    </td>
                                    <td>
                                        {{ $item->name}}
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('consumer.edit',$item->consumerId) }}">Edit</a>
                                        <a class="btn btn-primary" href="{{ route('editPassword',$item->consumerId) }}">Edit password</a>
                                        <button type="button" class="btn btn-danger" data-consumer_id="{{ $item->consumerId}}">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        @if(isset( $_GET['param']))
                            <div style="display: inline-block">
                                {!! $consumer->appends([ 'param' => $_GET['param'] ])->render(); !!}
                            </div>
                        @else
                            <div style="display: inline-block">
                                {!! $consumer->links() !!}
                            </div>
                        @endif
                    @endguest
                </div>
                @guest
                     <div class="create_btn">
                        <div class="pull-right">
                            <a class="btn btn-success" href="{{ route('consumer.create') }}">Create consumer</a>
                        </div>
                     </div>
                @else
                    <div class="order_list">
                        <span><b>Сортировка:</b></span>
                        <div class="pull-right">
                            <a class="btn btn-success" href="{{ route('home', ['param' =>  'id'])}}">
                                By id
                            </a>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-success" href="{{ route('home', ['param' =>  'login'])}}">
                                By login
                            </a>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-success" href="{{ route('home', ['param' =>  'email'])}}">
                                By E-mail
                            </a>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-success" href="{{ route('home', ['param' =>  'group'])}}">
                                By group
                            </a>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </main>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

<script>
    $(document).ready(function () {

        $('body').on('click', '.btn-danger', function(){

            var button = $(this);

            var consumer_id = button.data('consumer_id');

            $.ajax({
                type: 'POST',                //метод
                url: 'http://'+window.location.hostname+'/testwork/public/index.php'+'/delete',              //URL на который отправляем запрос
                data: {
                    "_token": "{{ csrf_token() }}",
                    consumer_id: consumer_id
                },
                cache: false,
                success: function(response) {    //код в этом блоке выполняется при успешной отправке сообщения
                    $('tr[data-consumer_id = '+consumer_id+']').remove();
                    var div = document.createElement('div');
                    div.className = "alert alert-success";
                    div.innerHTML = "<strong>"+response['msg']+"</strong>";
                    $('.justify-content-center').prepend(div);
                    $('.alert-success').css({"width" : "50%"});
                    setTimeout("" +
                        "$('.alert-success').remove()",
                        2000
                    );
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        });

        if ($('.alert-danger').length > 0) {
            setTimeout("" +
                "$('.alert-danger').remove()",
                2000
            );
        }else if($('.alert-success').length > 0){
            setTimeout("" +
                "$('.alert-success').remove()",
                2000
            );
        }

    });
</script>
