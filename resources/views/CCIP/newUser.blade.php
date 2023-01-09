@extends('adminlte::page')

@section('title', 'CCIP')

@section('content_header')
    <h1>Nuevo Usuario</h1>
@stop

@section('content')
    <div class="container">
        <form action="/home/createuser" enctype="multipart/form-data" method="post" class="row g-3">
            @csrf
            <div class="col-md-6">
                <label class="form-label" for="exampleInputEmail1" >Nombre</label>
                <input class="form-control" type="text" name="name" aria-describedby="emailHelp" value="{{ old('name') }}">
                @if ($errors->get('name'))
                    @foreach ($errors->get('name') as $error)
                        <p class="text-danger">
                            {{$error}}
                        </p>
                    @endforeach
                @endif
            </div>
            <div class="col-md-6">
                <label class="form-label" for="exampleInputPassword1" >Apellido</label>
                <input class="form-control" type="text" name="lastname" aria-describedby="emailHelp" value="{{ old('lastname') }}">
                @if ($errors->get('lastname'))
                    @foreach ($errors->get('lastname') as $error)
                        <p class="text-danger">
                            {{$error}}
                        </p>
                    @endforeach
                @endif
            </div>

            <div class="col-md-6">
                <label class="form-label" for="exampleInputEmail1" >Nombre de Usuario</label>
                <input class="form-control" type="text"  name="username" value="{{ old('username') }}">
                @if ($errors->get('username'))
                    @foreach ($errors->get('username') as $error)
                        <p class="text-danger">
                            {{$error}}
                        </p>
                    @endforeach
                @endif
            </div>
            <div class="col-md-6">
                <label class="form-label" for="exampleInputPassword1" >Correo</label>
                <input class="form-control" type="text" name="email" aria-describedby="emailHelp" value="{{ old('email') }}">
                @if ($errors->get('email'))
                    @foreach ($errors->get('email') as $error)
                        <p class="text-danger">
                            {{$error}}
                        </p>
                    @endforeach
                @endif
            </div>

            <div class="col-md-6">
                <label class="form-label" for="exampleInputPassword1" >Saldo</label>
                <input class="form-control" type="number" name="saldo"  value="{{ old('saldo') }}" placeholder="0.00">
            </div>
            <div class="col-md-4">
                <label class="form-label" for="exampleInputPassword1" >Contraseña</label>
                <input class="form-control" type="password" name="password" value="{{ old('password') }}">
                @if ($errors->get('password'))
                    @foreach ($errors->get('password') as $error)
                        <p class="text-danger">
                            {{$error}}
                        </p>
                    @endforeach
                @endif
            </div>
            <div class="col-md-2">
                <label class="form-label" >Estado</label>
                <select class="form-select" aria-label="Default select example" name="estado" required>
                    <option selected >Activo</option>
                    <option>Inactivo</option>
                </select>
            </div>

            <div class="mb-3">

            </div>
            <div class="row">
                <div class="col">
                    <button class="btn btn-success" type="submit">Crear</button>
                    <a class="btn btn-danger" href="/home">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

@stop
