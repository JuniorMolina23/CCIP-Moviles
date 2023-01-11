<?php

namespace App\Exports;

use App\Models\Otros;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OtrosExport implements FromView,WithColumnWidths,WithStyles
{
    var $fecha_inicio = "";
    var $fecha_fin = "";
    public function __construct($inicio,$fin){
        $this->fecha_inicio = $inicio;
        $this->fecha_fin = $fin;
    }
    public function view(): View
    {
        return view('Reportes.otros', [
            'otros' => Otros::with('UsuarioCCIP')
                ->whereBetween('fecha_otros',[$this->fecha_inicio,$this->fecha_fin])->get()
        ]);
    }
    public function columnWidths(): array{
        return [
            'A' => 5,
            'B' => 9,
            'C' => 20,
            'D' => 25,
            'E' => 15,
            'F' => 30,
            'G' => 60,
            'H' => 18,
            'I' => 16,
            'J' => 15,
            'K' => 15
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
