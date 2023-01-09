<table>
    <thead>
    <tr>
        <th></th>
        <th>Site Atendido</th>
        <th>Comentarios</th>
        <th>Nro_Inc_Crq</th>
        <th>Zona</th>
        <th>Fecha Traslado</th>
        <th>Usuario</th>
    </tr>
    </thead>
    <tbody>
    @foreach($traslados as $traslados)
        <tr>
            <td></td>
            <td>{{ $traslados->site_atendido}}</td>
            <td>{{ $traslados->comentarios}}</td>
            <td>{{ $traslados->Nro_Inc_Crq}}</td>
            <td>{{ $traslados->zona}}</td>
            <td>{{ $traslados->fecha_traslado}}</td>
            <td>{{ $traslados->UsuarioCCIP->name}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
