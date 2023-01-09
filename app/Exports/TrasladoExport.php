<?php

namespace App\Exports;

use App\Models\Traslado;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class TrasladoExport implements FromView, WithColumnWidths
{
    var $fecha_inicio = "";
    var $fecha_fin = "";
    public function __construct($inicio,$fin){
        $this->fecha_inicio = $inicio;
        $this->fecha_fin = $fin;
    }
    public function view(): View
    {
        return view('Reportes.traslados', [
            'traslados' => Traslado::with('UsuarioCCIP')->whereBetween('fecha_traslado',[$this->fecha_inicio,$this->fecha_fin])->get()
        ]);
    }
    public function columnWidths(): array{
        return [
            'A' => 5,
            'B' => 15,
            'C' => 30,
            'D' => 12,
            'E' => 12,
            'F' => 19,
            'G' => 12,
        ];
    }
}
