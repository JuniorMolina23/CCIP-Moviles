@extends('adminlte::page')

@section('title', 'CCIP')

@section('content_header')
    <h1>Generar Reportes Excel</h1>
@stop

@section('content')
    <div class="container col-12 col-md-8 col-lg-6 col-xl-7">
        <div class="card-body p-5 text-center">
            <form action="/home/generate" enctype="multipart/form-data" method="post" class="row g-3">
                @csrf
                <div class="col-md-6">
                    <label class="form-label" for="exampleInputEmail1">Desde:</label>
                    <input class="form-control text-center" type="date" name="inicio" aria-describedby="emailHelp" value="{{ old('inicio') }}">
                    @if ($errors->get('inicio'))
                        @foreach ($errors->get('inicio') as $error)
                            <p class="text-danger">
                                {{$error}}
                            </p>
                        @endforeach
                    @endif
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="exampleInputPassword1" >Hasta:</label>
                    <input class="form-control text-center" type="date" name="fin" aria-describedby="emailHelp" value="{{ old('fin') }}" >
                    @if ($errors->get('fin'))
                        @foreach ($errors->get('fin') as $error)
                            <p class="text-danger">
                                {{$error}}
                            </p>
                        @endforeach
                    @endif
                    <br>
                </div>
                <div class="container text-center">
                    <div class="col align-self-center">
                        <label class="form-label" >Tabla</label>
                        <select class="form-select" id="tabla" aria-label="Default select example" name="tabla" required>
                            <option value="0" selected>General</option>
                            <option value="1">Combustible</option>
                            <option value="2">Traslado</option>
                            <option value="3">Peaje</option>
                            <option value="4">Otros</option>
                        </select>
                    </div>
                    <br>
                </div>
                <div class="row">
                    <div class="col">
                        <a class="btn btn-danger" href="/home">Cancelar</a>
                        <button class="btn btn-success" id="btn" type="submit">Generar Excel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
@stop
