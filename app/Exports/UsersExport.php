<?php
namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        return User::where('role', '!=', 'admin')
            ->get()
            ->map(function ($user) {
                return [
                    $user->name,
                    $user->email,
                    is_array($user->department)
                        ? implode(', ', $user->department)
                        : $user->department,    
                    $user->experience,
                    $user->skill_level,
                    $user->shift,
                    $user->dob,
                    $user->role,
                ];
            });
    }
    
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Department',
            'Experience',
            'Skill Level',
            'Shift',
            'DOB',
            'Role'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:H1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FF0000'],
            ],
        ]);

        $highestColumn = $sheet->getHighestColumn();
        $highestRow = $sheet->getHighestRow();

        $sheet->getStyle('A2:' . $highestColumn . $highestRow)->applyFromArray([
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FFF9C4'],
            ],
        ]);
    }
}
