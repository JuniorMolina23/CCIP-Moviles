<?php

namespace App\Http\Controllers;

use App\Models\Combustible;
use App\Models\Operaciones;
use App\Models\Otros;
use App\Models\Peaje;
use App\Models\Traslado;
use App\Models\UsuarioCCIP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{
    public function gasto($usuario_id,$monto_total){
        $usuario = UsuarioCCIP::all('id','saldo')->where('id',"=",$usuario_id)->first();
        $usuario->saldo = $usuario->saldo-$monto_total;
        $usuario->save();
    }
    public function operacion($usuario_id,$tipo_doc,$cuadrilla,$nro_doc,$tipo,$monto,$fecha){
        $operacion = new Operaciones();
        $operacion->usuario_id = $usuario_id;
        $operacion->tipo_documento = $tipo_doc;
        $operacion->cuadrilla = $cuadrilla;
        $operacion->nro_documento = $nro_doc;
        $operacion->concepto = $tipo;
        $operacion->gasto = $monto;
        $operacion->fecha_operacion = $fecha;
        $operacion->save();
    }
    public function login(Request $request){
        $usuario =UsuarioCCIP::all()->where('username',$request->username)->first();
        if($usuario && Hash::check($request->password, $usuario->password) && $usuario->estado == 'Activo'){
            //Falta crear token
            return response()->json([
                'id'=>$usuario->id,
                'email'=>$usuario->email,
                'name'=>$usuario->name,
                'lastname'=>$usuario->lastname
                ]);
        }
    }
    public function traslado(Request $request){
        $monto_total=0;
        $traslado = new Traslado();
        $traslado->site_atendido = $request->site_atendido;
        $traslado->comentarios = $request->comentarios;
        $traslado->Nro_Inc_Crq = $request->Nro_Inc_Crq;
        $traslado->fecha_traslado = $request->fecha_traslado;
        $traslado->cuadrilla = $request->cuadrilla;
        $traslado->usuario_id = $request->usuario_id;
        $traslado->save();
        return response()->json([
            'response'=>"Insertado Correctamente"
        ]);
    }
    //combustible1
    public function combustible(Request $request){
        $combustible = new Combustible();
        $combustible->nro_factura = $request->nro_factura;
        $combustible->monto_total = $request->monto_total;
        $combustible->kilometraje = $request->kilometraje;
        $combustible->foto_km = $request->foto_km;
        $combustible->foto_factura = $request->foto_factura;
        $combustible->cuadrilla = $request->cuadrilla;
        $combustible->fecha_combustible = $request->fecha_combustible;
        $combustible->usuario_id = $request->usuario_id;
        $combustible->save();
        $this->operacion($request->usuario_id,"factura",$request->cuadrilla,$request->nro_factura,
            "Combustible",-$request->monto_total,$request->fecha_combustible);
        $this->gasto($request->usuario_id,$request->monto_total);
        return response()->json([
            'response'=>"Insertado Correctamente"
        ]);
    }
    public function peaje(Request $request){
        $peaje = new Peaje();
        $peaje->nro_factura = $request->nro_factura;
        //
        $imageName = time().'.png';
        if (! Storage::put('imagenes/'.$imageName,base64_decode( $request->foto_factura))) {
            return response()->json([
                'response'=>"No se pudo insertar"
            ]);
        }
        //
        $peaje->lugar_llegada = $request->lugar_llegada;
        $peaje->fecha_peaje = $request->fecha_peaje;
        $peaje->monto_total = $request->monto_total;
        $peaje->usuario_id = $request->usuario_id;
        $peaje->cuadrilla = $request->cuadrilla;
        $peaje->save();
        $this->operacion($request->usuario_id,"factura",$request->cuadrilla,$request->nro_factura,
            "Peaje",-$request->monto_total,$request->fecha_peaje);
        $this->gasto($request->usuario_id,$request->monto_total);
        return response()->json([
            'response'=>"Insertado Correctamente"
        ]);
    }
    public function otros(Request $request){
        $otros = new Otros();
        $otros->tipo_documento = $request->tipo_documento;
        $otros->numero_documento = $request->numero_documento;
        $otros->autorizacion = $request->autorizacion;
        $otros->descripcion = $request->descripcion;
        $otros->foto_otros = $request->foto_otros;
        $otros->fecha_otros = $request->fecha_otros;
        $otros->monto_total = $request->monto_total;
        $otros->usuario_id = $request->usuario_id;
        $otros->cuadrilla = $request->cuadrilla;
        $otros->save();
        $this->operacion($request->usuario_id,$request->tipo_documento,$request->cuadrilla,$request->numero_documento,
            "Otros",-$request->monto_total,$request->fecha_otros);
        $this->gasto($request->usuario_id,$request->monto_total);
        return response()->json([
            'response'=>"Insertado Correctamente"
        ]);
    }
    public function saldo(Request $request){
        $saldo = UsuarioCCIP::all('id','saldo')->where('id',$request->id)->first();
        $operaciones = Operaciones::with("UsuarioCCIP")->where('usuario_id',"=",$request->id)
            ->orderByDesc('fecha_operacion')->get()->take(10);
        return response()->json([
                'saldo'=> $saldo->saldo,
                'operacion' => $operaciones
            ]
        );
    }
}
