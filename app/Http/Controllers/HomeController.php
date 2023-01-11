<?php

namespace App\Http\Controllers;

use App\Exports\CombustibleExport;
use App\Exports\OperacionExport;
use App\Exports\OtrosExport;
use App\Exports\PeajeExport;
use App\Exports\TrasladoExport;
use App\Http\Requests\reporteRequest;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function generate(reporteRequest $request){
        $date = Carbon::now()->format('Y-m-d');
        $inicio = $request->inicio.' 00:00:00';
        $fin = $request->fin.' 23:59:59';
        switch ($request->tabla){
            case('0'):
                return Excel::download(new OperacionExport($inicio,$fin), 'General '.$date.'.xlsx');
            case('1'):
                return Excel::download(new CombustibleExport($inicio,$fin), 'Combustible '.$date.'.xlsx');
            case('2'):
                return Excel::download(new TrasladoExport($inicio,$fin), 'Traslado '.$date.'.xlsx');
            case('3'):
                return Excel::download(new PeajeExport($inicio,$fin), 'Peaje '.$date.'.xlsx');
            case('4'):
                return Excel::download(new OtrosExport($inicio,$fin), 'Otros '.$date.'.xlsx');
            default:
                return redirect('/home');
        }
        return redirect('/home');
    }
    public function generar(){
        return view('Reportes.generar');
    }

}
