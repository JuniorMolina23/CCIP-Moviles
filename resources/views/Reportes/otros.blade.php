@php
    $x = 1;
@endphp
<table>
    <thead>
    <tr></tr>
    <tr>
        <th></th>
        <th>N°</th>
        <th>Tipo de documento</th>
        <th>Numero de documento</th>
        <th>Autorizacion</th>
        <th>Descripcion</th>
        <th>Imagen</th>
        <th>Fecha</th>
        <th>Monto</th>
        <th>Cuadrilla</th>
        <th>Usuario</th>
    </tr>
    </thead>
    <tbody>
    @foreach($otros as $otros)
        <tr>
            <td></td>
            <td>{{$x}}</td>
            <td>{{ $otros->tipo_documento }}</td>
            <td>{{ $otros->numero_documento }}</td>
            <td>{{ $otros->autorizacion }}</td>
            <td>{{ $otros->descripcion }} </td>
            <td>{{ $otros->foto_otros }}</td>
            <td>{{ $otros->fecha_otros }}</td>
            <td>{{ $otros->monto_total }}</td>
            <td>{{ $otros->cuadrilla }}</td>
            <td>{{ $otros->UsuarioCCIP->name }}</td>
        </tr>
        @php
            $x = $x+1;
        @endphp
    @endforeach
    </tbody>
</table>
