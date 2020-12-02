<?php

namespace App\Exports;

use App\Models\Pago;
use App\Models\Usuario;
use App\Models\Compra;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;

class PagoCompraExport implements FromQuery, WithHeadings, WithEvents, WithStyles, WithMapping, ShouldAutoSize
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
        return Pago::where('id',$this->id);
    }

    public function map($pago): array
    {
        $compra = Compra::find($pago->compra_id);
        $usuario = Usuario::find($compra->usuario_id);
        return [
            $pago->id,
            $pago->direccion,
            $pago->monto,
            $pago->fecha,
            $pago->estado,
            $pago->compra_id,
            $compra->deuda_total,
            $compra->deuda_pendiente,
            $compra->fecha_siguiente_pago,
            $compra->estado,
            $compra->usuario_id,
            $usuario->nombre,
            $usuario->primer_apellido,
            $usuario->segundo_apellido,
            $usuario->email,
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
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center'],['font' => ['size' => 25]]],
            'A1:O1' => ['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['argb' => 'd9e2f2']]],
        ];
    }


    public function headings(): array
    {
        return [
            [
                'Id',
                'Dirección',
                'Monto',
                'Fecha',
                'Estado',
                'ID Compra',
                'Deuda Total',
                'Deuda Pendiente',
                'Fecha Siguiente Pago',
                'Estado',
                'ID Usuario',
                'Nombre',
                'Primer Apellido',
                'Segundo Apellido',
                'Email',
            ],

        ];
    }
}
