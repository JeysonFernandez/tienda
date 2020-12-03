<?php

namespace App\Exports;

use App\Models\Compra;
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

class CompraUsuarioExport implements FromQuery, WithHeadings, WithEvents, WithStyles, WithMapping, ShouldAutoSize
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
        return Compra::where('usuario_id',$this->id);
    }

    public function map($compra): array
    {
        $usuario = Usuario::find($compra->usuario_id);
        return [
            $compra->id,
            $compra->deuda_total,
            $compra->deuda_pendiente,
            $compra->fecha_siguiente_pago,
            $compra->fecha_compra,
            ($compra->estado()),
            $compra->compraproducto->count(),
            $compra->pedido_id,
            $compra->pedido->pedidoproducto->sum('costo'),
            $compra->pedido->pedidoproducto->count(),
            $compra->usuario_id,
            $usuario->nombre,
            $usuario->primer_apellido,
            $usuario->segundo_apellido,
            $usuario->email,
            ($usuario->estado),
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

            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center'],['font' => ['size' => 25]]],
            'A1:P1' => ['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['argb' => 'd9e2f2']]],
        ];
    }


    public function headings(): array
    {
        return [
            [
                'Id',
                'Deuda Total',
                'Deuda Pendiente',
                'Fecha Siguiente Pago',
                'Fecha Compra',
                'Estado',
                'Cantidad Productos',
                'ID Pedido',
                'Monto total',
                'Cantidad Productos',
                'ID Usuario',
                'Nombre',
                'Primer Apellido',
                'Segundo Apellido',
                'Email',
                'Estado'


            ],

        ];
    }
}
