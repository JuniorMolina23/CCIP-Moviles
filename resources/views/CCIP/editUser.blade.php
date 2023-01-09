@extends('adminlte::page')

@section('title', 'CCIP')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')
    <div class="container">
        <form action="/home/update/{{$usuario->id}}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="exampleInputEmail1" >Nombre</label>
                <input class="form-control" type="text" name="name" aria-describedby="emailHelp" value="{{$usuario->name}}">
            </div>

            <div class="mb-3">
                <label class="form-label" for="exampleInputPassword1" >Apellido</label>
                <input class="form-control" type="text" name="lastname" aria-describedby="emailHelp" value="{{$usuario->lastname }}">
            </div>
            <div class="mb-3">
                <label class="form-label" for="exampleInputPassword1" >Nombre de Usuario</label>
                <input class="form-control" type="text"  name="username" value="{{$usuario->username}}">
            </div>
            <div class="mb-3">
                <label class="form-label" for="exampleInputPassword1" >Correo</label>
                <input class="form-control" type="email" name="email" value="{{$usuario->email}}">
            </div>
            <div class="mb-3">
                <label class="form-label" >Estado</label>
                <select class="form-select" aria-label="Default select example" name="estado" required>
                    @if($usuario->estado == "Activo")
                        <option selected >Activo</option>
                        <option>Inactivo</option>
                    @else
                        <option>Activo</option>
                        <option selected >Inactivo</option>
                    @endif
                </select>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <a class="btn btn-success" href="/home/edit/password/{{$usuario->id}}">Cambiar Contraseña</a>
                </div>
                <div class="text-end col">
                    <a class="btn btn-danger" href="/home">Cancelar</a>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Actualizar</button>
                </div>
            </div>
            <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizacion</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿Esta seguro que desea actualizar este usuario?
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Actualizar</button>
                        </div>
                    </div>
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
