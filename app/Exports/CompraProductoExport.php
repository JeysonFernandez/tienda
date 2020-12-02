<?php

namespace App\Exports;

use App\Models\Compra;
use App\Models\Usuario;
use App\Models\CompraProducto;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;

class CompraProductoExport implements FromQuery, WithHeadings, WithEvents, WithStyles, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
    public function query()
    {
        return CompraProducto::where('compra_id',$this->id);
    }

    public function map($compraproducto): array
    {
        $compra = Compra::find($compraproducto->compra_id);

        return [
            $compraproducto->id,
            $compraproducto->compra_id,
            $compra->deuda_total,
            $compra->deuda_pendiente,
            $compra->fecha_siguiente_pago,
            $compra->fecha_compra,
            $compra->estado,
            $compra->compraproducto->count(),
            $compraproducto->productos->id,
            $compraproducto->productos->fecha_creacion,
            $compraproducto->productos->tipo->nombre,
            $compraproducto->productos->talla->nombre,
            $compraproducto->productos->categoria->nombre,
            $compraproducto->productos->marca->nombre,
            $compraproducto->productos->proveedor->nombre,
            $compraproducto->productos->color->nombre,
            $compraproducto->productos->genero->nombre,
            $compraproducto->productos->stock_actual,
            $compraproducto->productos->stock_critico,
            $compraproducto->productos->precio_unidad,
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
                $event->sheet->getDelegate()->mergeCells('O1:O1');
                $event->sheet->getDelegate()->mergeCells('P1:P1');
                $event->sheet->getDelegate()->mergeCells('Q1:Q1');
                $event->sheet->getDelegate()->mergeCells('R1:R1');
                $event->sheet->getDelegate()->mergeCells('S1:S1');
                $event->sheet->getDelegate()->mergeCells('T1:T1');
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center'],['font' => ['size' => 25]]],
            'A1:T1' => ['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['argb' => 'd9e2f2']]],
        ];
    }


    public function headings(): array
    {
        return [
            [
                'ID Compra Producto',
                'ID Compra',
                'Deuda Total',
                'Deuda Pendiente',
                'Fecha Siguiente Pago',
                'Fecha Compra',
                'Estado',
                'Cantidad Productos',
                'ID Producto',
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


            ],

        ];
    }
}
