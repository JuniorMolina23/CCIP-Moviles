<?php

namespace App\Exports;

use App\Models\Combustible;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class CombustibleExport implements FromView,WithColumnWidths
{
    var $fecha_inicio = "";
    var $fecha_fin = "";
    public function __construct($inicio,$fin){
        $this->fecha_inicio = $inicio;
        $this->fecha_fin = $fin;
    }
    public function view(): View
    {
        return view('Reportes.combustibles', [
            'combustible' => Combustible::with('UsuarioCCIP')->whereBetween('fecha_combustible',[$this->fecha_inicio,$this->fecha_fin])->get()
        ]);
    }
    public function columnWidths(): array{
        return [
            'A' => 5,
            'B' => 11,
            'C' => 12,
            'D' => 11,
            'E' => 50,
            'F' => 50,
            'G' => 20,
            'H' => 17,
        ];
    }
}
