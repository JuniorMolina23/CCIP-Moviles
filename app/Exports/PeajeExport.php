<?php

namespace App\Exports;

use App\Models\Operaciones;
use App\Models\Peaje;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PeajeExport implements FromView,WithColumnWidths,WithStyles
{
    var $fecha_inicio = "";
    var $fecha_fin = "";
    public function __construct($inicio,$fin){
        $this->fecha_inicio = $inicio;
        $this->fecha_fin = $fin;
    }
    public function view(): View
    {
        return view('Reportes.peaje', [
            'peajes' => Peaje::with('UsuarioCCIP')
                ->whereBetween('fecha_peaje',[$this->fecha_inicio,$this->fecha_fin])->get()
        ]);
    }
    public function columnWidths(): array{
        return [
            'A' => 5,
            'B' => 9,
            'C' => 15,
            'D' => 60,
            'E' => 17,
            'F' => 19,
            'G' => 17,
            'H' => 15,
            'I' => 17,
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            2    => ['font' => ['bold' => true]],
        ];
    }
}
