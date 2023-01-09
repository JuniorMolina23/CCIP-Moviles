<table>
    <thead>
    <tr>
        <th></th>
        <th>Nro Factura</th>
        <th>Monto Total</th>
        <th>Kilometraje</th>
        <th>Foto KM</th>
        <th>Foto Factura</th>
        <th>Fecha</th>
        <th>Personal</th>
    </tr>
    </thead>
    <tbody>
    @foreach($combustible as $combustible)
        <tr>
            <td></td>
            <td>{{ $combustible->nro_factura }}</td>
            <td>{{ $combustible->monto_total}}</td>
            <td>{{ $combustible->kilometraje}}</td>
            <td>{{ $combustible->foto_km}}</td>
            <td>{{ $combustible->foto_factura}}</td>
            <td>{{$combustible->fecha_combustible}}</td>
            <td>{{ $combustible->UsuarioCCIP->name}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
