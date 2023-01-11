<?php

namespace App\Http\Controllers;

use App\Models\Combustible;
use App\Models\Operaciones;
use App\Models\Otros;
use App\Models\Peaje;
use App\Models\Traslado;
use App\Models\UsuarioCCIP;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Psy\Readline\Hoa\Console;

class ApiController extends Controller
{
    public  function validar($id,$token){
        $tokenv = UsuarioCCIP::all('id','remember_token')->where('id',"=",$id)->first;
        if ($tokenv->remember_token->remember_token == $token){
            return true;
        }
        return false;
    }
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
            return response()->json([
                'id'=>$usuario->id,
                'email'=>$usuario->email,
                'name'=>$usuario->name,
                'lastname'=>$usuario->lastname,
                'token'=>$usuario->remember_token
                ]);
        }
        else{
            return response()->json([
                'token'=>0
                ]);
        }
    }
    public function traslado(Request $request){
        $v = $this->validar($request->usuario_id,$request->token);
        if ($v){
            $traslado = new Traslado();
            $traslado->site_atendido = $request->site_atendido;
            $traslado->comentarios = $request->comentarios;
            $traslado->Nro_Inc_Crq = $request->Nro_Inc_Crq;
            $traslado->fecha_traslado = $request->fecha_traslado;
            $traslado->cuadrilla = $request->cuadrilla;
            $traslado->usuario_id = $request->usuario_id;
            $traslado->save();
            return response()->json([
                'response'=>1
            ]);
        }
        return response()->json([
            'response'=>0
        ]);
    }
    //combustible1
    public function combustible(Request $request){
        $v = $this->validar($request->usuario_id,$request->token);
        if ($v){
            $date = Carbon::now()->format('Y-m-d');
            $combustible = new Combustible();
            $combustible->nro_factura = $request->nro_factura;
            $combustible->monto_total = $request->monto_total;
            $combustible->kilometraje = $request->kilometraje;

            $image = str_replace('data:image/png;base64,', '', $request->foto_km);
            $image = str_replace(' ', '+', $image);
            $imageContnt = base64_decode($image);
            $path = 'cmbkm'.$date.time().'.png';
            $ruta = "http://192.168.80.16:8000/imagenes/".$path;
            File::put(public_path('imagenes/').$path,$imageContnt);
            $combustible->foto_km = $ruta;

            $image2 = str_replace('data:image/png;base64,', '', $request->foto_factura);
            $image2 = str_replace(' ', '+', $image2);
            $imageContnt2 = base64_decode($image2);
            $path = 'cmbfc'.$date.time().'.png';
            $ruta2 = "http://192.168.80.16:8000/imagenes/".$path;
            File::put(public_path('imagenes/').$path,$imageContnt2);
            $combustible->foto_factura = $ruta2;

            $combustible->cuadrilla = $request->cuadrilla;
            $combustible->fecha_combustible = $request->fecha_combustible;
            $combustible->usuario_id = $request->usuario_id;
            $combustible->save();
            $this->operacion($request->usuario_id,"factura",$request->cuadrilla,$request->nro_factura,
                "Combustible",-$request->monto_total,$request->fecha_combustible);
            $this->gasto($request->usuario_id,$request->monto_total);
            return response()->json([
                'response'=>1
            ]);
        }
        return response()->json([
            'response'=>0
        ]);
    }
    public function peaje(Request $request){
        $v = $this->validar($request->usuario_id,$request->token);
        if ($v) {
            $date = Carbon::now()->format('Y-m-d');
            $peaje = new Peaje();
            $peaje->nro_factura = $request->nro_factura;

            $image = str_replace('data:image/png;base64,', '', $request->foto_factura);
            $image = str_replace(' ', '+', $image);
            $imageContnt = base64_decode($image);
            $path = 'tr' . $date . time() . '.png';
            $ruta = "http://192.168.80.16:8000/imagenes/" . $path;
            File::put(public_path('imagenes/') . $path, $imageContnt);
            $peaje->foto_factura = $ruta;

            $peaje->lugar_llegada = $request->lugar_llegada;
            $peaje->fecha_peaje = $request->fecha_peaje;
            $peaje->monto_total = $request->monto_total;
            $peaje->usuario_id = $request->usuario_id;
            $peaje->cuadrilla = $request->cuadrilla;
            $peaje->save();
            $this->operacion($request->usuario_id, "factura", $request->cuadrilla, $request->nro_factura,
                "Peaje", -$request->monto_total, $request->fecha_peaje);
            $this->gasto($request->usuario_id, $request->monto_total);
            return response()->json([
                'response' => 1
            ]);
        }
        return response()->json([
            'response'=>0
        ]);

    }
    public function otros(Request $request){
        $v = $this->validar($request->usuario_id,$request->token);
        if ($v) {
            $date = Carbon::now()->format('Y-m-d');
            $otros = new Otros();
            $otros->tipo_documento = $request->tipo_documento;
            $otros->numero_documento = $request->numero_documento;
            $otros->autorizacion = $request->autorizacion;
            $otros->descripcion = $request->descripcion;
            $image = str_replace('data:image/png;base64,', '', $request->foto_otros);
            $image = str_replace(' ', '+', $image);
            $imageContnt = base64_decode($image);
            $path = 'ot' . $date . time() . '.png';
            $ruta = "http://192.168.80.16:8000/imagenes/" . $path;
            File::put(public_path('imagenes/') . $path, $imageContnt);
            $otros->foto_otros = $ruta;
            $otros->fecha_otros = $request->fecha_otros;
            $otros->monto_total = $request->monto_total;
            $otros->usuario_id = $request->usuario_id;
            $otros->cuadrilla = $request->cuadrilla;
            $otros->save();
            $this->operacion($request->usuario_id, $request->tipo_documento, $request->cuadrilla, $request->numero_documento,
                "Otros", -$request->monto_total, $request->fecha_otros);
            $this->gasto($request->usuario_id, $request->monto_total);
            return response()->json([
                'response' => 1
            ]);
        }
        return response()->json([
            'response'=>0
        ]);
    }
    public function saldo(Request $request){
        $v = $this->validar($request->id,$request->token);
        if ($v){
            $saldo = UsuarioCCIP::all('id','saldo')->where('id',$request->id)->first();
            $operaciones = Operaciones::with("UsuarioCCIP")->where('usuario_id',"=",$request->id)
                ->orderByDesc('fecha_operacion')->get()->take(10);
            return response()->json([
                'response'=>1,
                'saldo'=> $saldo->saldo,
                'operacion' => $operaciones
                ]
            );
        }
        return response()->json([
            'response'=>0
        ]);
    }
}
