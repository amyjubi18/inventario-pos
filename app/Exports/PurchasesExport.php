<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;

class PurchasesExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithEvents
{
    protected $purchases;
    public function __construct($purchases)
    {
        $this->purchases = $purchases;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->purchases ->map(function($purchase){
            return [
                $purchase->id,
                $purchase->date,
                $purchase->serie,
                $purchase->correlative,
                $purchase->supplier->identity->name,
                $purchase->supplier->document_number,
                $purchase->supplier->name,
                $purchase->total,



            ];
        });
    }

    public function headings(): array
    {
        return [
            'id',
            'Fecha',
            'Serie',
            'Correlativo',
            'Proveedor (Identidad)',
            'N Documento',
            'Nombre del Proveedor',
            'Total',


        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();
        $lastColumn = $sheet->getHighestColumn();

        $fullRange = 'A1:' . $lastColumn . $lastRow;
        return [
            1=>[
                    'font' => [
                        'bold' => true,
                        'size' => 14
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => 'FFCCCCCC',
                        ],
                    ],
                    'alignment' => [
                        'horizontal' =>'center',
                    ],
                ],
            $fullRange => [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                ],
        ];
    }
    public function registerEvents():  array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->setSelectedCell('A1');

            },
        ];
    }
}
