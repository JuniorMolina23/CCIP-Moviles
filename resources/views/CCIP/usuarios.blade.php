@extends('adminlte::page')

@section('title', 'CCIP')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')
    <div class="container">
        <a type="button" href="/home/nuevoUsuario" class="btn btn-success">+ Agregar</a>
        <br>
        <br>
        <table id="example" class="table table-striped" >
            <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Nombre de Usuario</th>
                <th scope="col">Correo</th>
                <th scope="col">Estado</th>
                <th scope="col">Saldo</th>
                <th scope="col">Recargar</th>
                <th scope="col">Editar</th>
            </tr>
            </thead>
            <tbody>
            @foreach($usuarios as $usuarios)
                <tr class="tr">
                    <td>{{$usuarios->name}}</td>
                    <td>{{$usuarios->lastname}}</td>
                    <td>{{$usuarios->username}}</td>
                    <td>{{$usuarios->email}}</td>
                    <td>{{$usuarios->estado}}</td>
                    <td>S/{{$usuarios->saldo}}</td>
                    <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$usuarios->id}}">Recargar</button></td>
                    <td><a class="btn btn-warning" href="/home/mostrarUsuario/{{$usuarios->id}}">Editar</a></td>
                </tr>
                <div class="modal fade" id="staticBackdrop{{$usuarios->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="post" action="/home/recargar/{{$usuarios->id}}">
                                @csrf
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Realizar recarga a <b>{{$usuarios->name}}</b></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <label class="col-form-label">Monto</label>
                                    <input name="recarga" type="text" class="form-control" placeholder="0.0">
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-success" value="Recargar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>
        <div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

@stop

