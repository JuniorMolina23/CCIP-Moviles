@extends('adminlte::page')

@section('title', 'CCIP')

@section('content_header')
    <h1>Cambiar contraseña</h1>
@stop

@section('content')
        <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" >
                    <div class="card-body p-5 text-center">
                        <form action="/home/update/password/{{$id}}" method="post" class="text-center">
                            @csrf
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label" >Nueva Contraseña</label>
                                <input type="text" class="form-control" name="password" id="recipient-name" value="{{ old('password') }}">
                                @if($errors->get('password'))
                                    @foreach ($errors->get('password') as $error)
                                        <p class="text-danger">
                                            {{$error}}<br>
                                        </p>
                                        @endforeach
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label" >Confirmar Contraseña</label>
                                <input type="text" class="form-control" id="recipient-name" name="password_confirmation" value="{{ old('password_confirmation') }}">
                                @if($errors->get('password_confirmation'))
                                    @foreach ($errors->get('password_confirmation') as $error)
                                        <p class="text-danger">
                                            {{$error}}<br>
                                        </p>
                                    @endforeach
                                @endif
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <a type="button" class="btn btn-danger" href="/home/mostrarUsuario/{{$id}}">Cancelar</a>
                                </div>
                                <div class="text-end col">
                                    <button type="submit" class="btn btn-success">Cambiar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

@stop
