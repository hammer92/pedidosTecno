<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
    <title><--></title>
    <style>
        body{
            font-family: 'Righteous', cursive !important;
        }
        .rows{
            text-align: center;
            border-bottom: 1px solid #e9e8e9;
            margin-bottom: 40px !important;
        }
        .nav-link{
            font-size: 24px;
            color: #898e98;
            padding: 20px 10px;
            margin: 0 15px;
            cursor: pointer;
            font-weight: 400;
            letter-spacing: -1px;
            border-bottom: 3px solid transparent;
        }
        .active{
            border-bottom: 3px solid #75b432;
            color: #272c33 !important;
            background-color: #fff !important;
            border-radius: 1px !important;
        }
       .name{
           font-size: 2rem;
           font-family: Righteous,sans-serif;
           line-height: 30px;
           margin: 0 0 10px;
           text-transform: none;
       }
        .decreption{
            margin-bottom: 20px;
            min-height: 45px;
            color: #898e98;
        }
        .price{
            font-size: 24px;
        }

        .blockquote-footer::before {
            content: "";
        }
        .bg-danger {
            background-color: #BE102D!important;
        }
        #categoria{
            height: 100px;
            overflow-x: auto;
        }
        @media screen and (max-width:640px) {
            .nav{
                flex-wrap: unset !important;
            }
        }


    </style>
</head>
<body>
<div id="app">
<header class="fixed-top">
    <!-- Navegacion -->
    <div class="bg-danger">
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4  container">

            <h5 class="my-0 mr-md-auto font-weight-normal">
                <img src="https://wpopaldemo.com/burgerslap/wp-content/themes/burgerslap/images/logo.png" width="119" height="110" alt="">
            </h5>
            <nav class="my-0 mr-md-auto">
                <blockquote class="blockquote text-center text-white mb-0">
                    <p class="mb-0 h2">Domicilio Gratis</p>
                    <footer class="blockquote-footer h3 text-white-50">Cel <cite title="Source Title">304 317 1200</cite></footer>
                </blockquote>
            </nav>
            <div class="my-0 mr-md-0">
                <div class="row">
                    @if (!Auth::guest())
                        <div class="col"><carro-compra :usuario_id="{!! Auth::user()->id !!}"></carro-compra></div>
                        <div class="pull-right">
                            <a href="{!! url('/logout') !!}" class="btn btn-default btn-flat"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Salir
                            </a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    @else
                        <div class="col"><carro-compra @login="modallogin = !modallogin"></carro-compra></div>
                        <div class="col"><a @click="modallogin = !modallogin" class="btn btn-outline-light btn-lg ml-4 text-white">Ingresar</a></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal" style="background: #000000a1;display: block" v-show="modallogin">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="modallogin = !modallogin">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- /.login-logo -->
                    <div class="login-box-body">
                        <p class="login-box-msg">
                            Inicia sesión para comenzar a comprar</p>

                        <form method="post" action="{{ url('/login') }}">
                            {!! csrf_field() !!}

                            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Correo">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                                @endif
                            </div>

                            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input type="password" class="form-control" placeholder="Contraseña" name="password">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                                @endif

                            </div>
                            <div class="form-group">
                                <!-- /.col -->
                                <div class="col-xs-12">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat">Inicia</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>

                        <a href="{{ url('/password/reset') }}">Olvidé mi contraseña</a><br>
                        <a href="{{ url('/register') }}" class="text-center">Registra una nueva membresía</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--tabps de categorias-->
    <div class="col-12 rows bg-white">
        <div class="container">
            <ul class="nav nav-pills" id="categoria" role="tablist">
                @forelse ($categorias as $item)
                    @if ($loop->first)
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" @click="categoria({{ $item->id }})" > {{ $item->titulo }}</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" id="pills-home-tab" data-toggle="pill" @click="categoria({{ $item->id }})" > {{ $item->titulo }}</a>
                        </li>
                    @endif

                @empty
                    <p>No users</p>
                @endforelse
            </ul>
        </div>

    </div>
</header>

<!--Lista de Productos-->
<producto-tabs :categoria_id="categoria_id"></producto-tabs>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="/js/app.js"></script>

</body>
</html>