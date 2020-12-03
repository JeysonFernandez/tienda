<?php

namespace App\Exports;

use App\Models\Usuario;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;

class UsuarioExport implements FromQuery, WithHeadings, WithEvents, WithStyles, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Usuario::query();
    }

    public function map($usuario): array
    {

        return [
            $usuario->id,
            $usuario->nombre,
            $usuario->primer_apellido,
            $usuario->segundo_apellido,
            $usuario->email,
            ($usuario->estado),
            $usuario->deuda_total,
            $usuario->compras->count(),
            $usuario->compras->sum('deuda_total'),
            $usuario->pedidos->count(),
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->mergeCells('A1:A1');
                $event->sheet->getDelegate()->mergeCells('B1:B1');
                $event->sheet->getDelegate()->mergeCells('C1:C1');  // Datos Ficha
                $event->sheet->getDelegate()->mergeCells('D1:D1');
                $event->sheet->getDelegate()->mergeCells('E1:E1');
                $event->sheet->getDelegate()->mergeCells('F1:F1');
                $event->sheet->getDelegate()->mergeCells('G1:G1');
                $event->sheet->getDelegate()->mergeCells('H1:H1');
                $event->sheet->getDelegate()->mergeCells('I1:I1');
                $event->sheet->getDelegate()->mergeCells('J1:J1');
                $event->sheet->getDelegate()->mergeCells('K1:K1');
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center'],['font' => ['size' => 25]]],
            'A1:K1' => ['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['argb' => 'd9e2f2']]],
        ];
    }


    public function headings(): array
    {
        return [
            [
                'Id',
                'Nombre',
                'Primer Apellido',
                'Segundo Apellido',
                'Email',
                'Estado Calidad',
                'Conocido',
                'Deuda Total',
                'Cantidad Compras',
                'Monto Total Comprado',
                'Cantidad Pedidos',
            ],

        ];
    }
}
