<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BookingsExport implements FromCollection, WithHeadings, WithStyles
{
    protected $exportData;

    public function __construct($exportData = [])
    {
        $this->exportData = $exportData;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->exportData;
    }

    public function headings(): array
    {
        return [
            'ID','Car Name', 'Pickup Date', 'Drop off Date', 'Pickup Time', 'Drop off Time', 'Rate', 'Pickup Location', 'Pickup Address', 'Drop off Location', 'Drop off Address',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:K1')->getFont()->setBold(true);
        $sheet->getStyle('A1:K1')->getFill()->setFillType('solid')->getStartColor()->setARGB('FFFFE599');
        
        // Add borders to all cells
        $sheet->getStyle('A1:K' . $sheet->getHighestRow())
              ->getBorders()
              ->getAllBorders()
              ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
