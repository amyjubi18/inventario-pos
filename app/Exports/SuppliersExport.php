<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;

class SuppliersExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithEvents
{
    protected $suppliers;
    public function __construct($suppliers)
    {
        $this->suppliers = $suppliers;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->suppliers ->map(function($supplier){
            return [
                $supplier->id,
                $supplier->identity->name,
                $supplier->document_number,
                $supplier->name,
                $supplier->address,
                $supplier->email,
                $supplier->phone,



            ];
        });
    }

    public function headings(): array
    {
        return [
            'id',
            'Identidad',
            'N Documento',
            'Nombre',
            'Direccion',
            'Correo Electronico',
            'Telefono',

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
