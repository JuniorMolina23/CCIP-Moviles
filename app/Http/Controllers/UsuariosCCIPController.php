<?php

namespace App\Http\Controllers;

use App\Http\Requests\CCIPRequest;
use App\Http\Requests\forgotRequest;
use App\Models\Operaciones;
use App\Models\UsuarioCCIP;
use App\Models\UsuarioCCIP as usuarios;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UsuariosCCIPController extends Controller
{

    public function index(){
        $usuarios = usuarios::all();
        return view('CCIP.usuarios')->with('usuarios',$usuarios);
    }

    public function create(CCIPRequest $request){
        $usuario = new UsuarioCCIP();
        $usuario->name = $request->get('name');
        $usuario->lastname = $request->get('lastname');
        $usuario->username = $request->get('username');
        $usuario->email = $request->get('email');
        $usuario->saldo = $request->get('saldo');
        $usuario->password = ($request->password);
        $usuario->estado = $request->get('estado');
        $usuario->remember_token = Str::uuid();
        $usuario->save();
        return redirect('/home');
    }
    public function modify($id){
        $usuario = UsuarioCCIP::all('id','name','lastname','username','email','estado')
            ->where('id',"=",$id)->first();
        return view('CCIP.editUser')->with('usuario',$usuario);
    }
    public function update(Request $request, $id){
        $usuario = UsuarioCCIP::all()->where('id',"=",$id)->first();
        $usuario->name = $request->name;
        $usuario->lastname = $request->lastname;
        $usuario->username = $request->username;
        $usuario->email = $request->email;
        if ($usuario->estado != $request->estado){
            $usuario->estado = $request->estado;
            $usuario->remember_token = Str::uuid();
        }
        $usuario->save();
        return redirect('/home');
    }

    //password
    public function edit_password($id){
        return view('CCIP.forgotPassword')->with('id',$id);
    }
    public function update_password(forgotRequest $request, $id){
        $usuario = UsuarioCCIP::all()->where('id',"=",$id)->first();
        $usuario->password = ($request->password);
        $usuario->save();
        return redirect('/home/mostrarUsuario/'.$id);
    }
    public function recargar(Request $request, $id){
        $usuario = UsuarioCCIP::all('id','saldo')->where('id',"=",$id)->first();
        $usuario->saldo = $usuario->saldo+$request->recarga;
        $usuario->save();
        return redirect('/home');
    }
}
