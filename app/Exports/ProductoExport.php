<?php

namespace App\Exports;

use App\Models\Producto;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;

class ProductoExport implements FromQuery, WithHeadings, WithEvents, WithStyles, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Producto::query();
    }

    public function map($producto): array
    {

        return [
            $producto->id,
            $producto->fecha_creacion,
            $producto->tipo->nombre,
            $producto->talla->nombre,
            $producto->categoria->nombre,
            $producto->marca->nombre,
            $producto->proveedor->nombre,
            $producto->color->nombre,
            $producto->genero->nombre,
            $producto->stock_actual,
            $producto->stock_critico,
            $producto->precio_unidad,
            ($producto->cantidad_vendida < 1 ? 0: $producto->cantidad_vendida),
            ($producto->estado()),
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
                $event->sheet->getDelegate()->mergeCells('L1:L1');
                $event->sheet->getDelegate()->mergeCells('M1:M1');
                $event->sheet->getDelegate()->mergeCells('N1:N1');
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center'],['font' => ['size' => 25]]],
            'A1:N1' => ['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['argb' => 'd9e2f2']]],
        ];
    }


    public function headings(): array
    {
        return [
            [
                'Id',
                'Fecha Creación',
                'Tipo',
                'Talla',
                'Categoria',
                'Marca',
                'Proveedor',
                'Color',
                'Genero',
                'Stock Actual',
                'Stock Critico',
                'Precio Unidad',
                'Cantidad Vendida',
                'Estado'


            ],

        ];
    }
}
