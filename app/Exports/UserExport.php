<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UserExport implements FromCollection, WithHeadings, WithStyles
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
            'ID','First Name', 'Last Name', 'Email', 'Phone', 'Emirate'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:F1')->getFont()->setBold(true);
        $sheet->getStyle('A1:F1')->getFill()->setFillType('solid')->getStartColor()->setARGB('FFFFE599');
        
        // Add borders to all cells
        $sheet->getStyle('A1:F' . $sheet->getHighestRow())
              ->getBorders()
              ->getAllBorders()
              ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
