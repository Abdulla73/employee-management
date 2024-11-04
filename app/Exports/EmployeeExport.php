<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmployeeExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        return Employee::with(['educations', 'histories'])->get();
    }
    public function map($employee): array
    {
        $educationDegrees = $employee->educations->map(function ($education) {
            return $education->degree;
        })->implode(PHP_EOL);

        $educationInstitutes = $employee->educations->map(function ($education) {
            return $education->institute;
        })->implode(PHP_EOL);

        $educationYears = $employee->educations->map(function ($education) {
            return $education->passing_year;
        })->implode(PHP_EOL);

        $educationResults = $employee->educations->map(function ($education) {
            return $education->result;
        })->implode(PHP_EOL);

        $historyInstitutes = $employee->histories->map(function ($history) {
            return $history->institute;
        })->implode(PHP_EOL);

        $historyPositions = $employee->histories->map(function ($history) {
            return $history->position;
        })->implode(PHP_EOL);

        $historyStartDates = $employee->histories->map(function ($history) {
            return $history->start_date;
        })->implode(PHP_EOL);

        $historyEndDates = $employee->histories->map(function ($history) {
            return $history->end_date;
        })->implode(PHP_EOL);

        $historyAwards = $employee->histories->map(function ($history) {
            return $history->special_award;
        })->implode(PHP_EOL);
        return [
            $employee->name,
            $employee->email,
            $employee->dob,
            $employee->phone,
            $employee->address,
            $educationDegrees,
            $educationInstitutes,
            $educationYears,
            $educationResults,
            $historyInstitutes,
            $historyPositions,
            $historyStartDates,
            $historyEndDates,
            $historyAwards,
        ];
    }


    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Date of Birth',
            'Phone',
            'Address',
            'Education Degree',
            'Education Institute',
            'Passing Year',
            'Result',
            'History Institute',
            'Position',
            'Start Date',
            'End Date',
            'Special Award',
        ];
    }
}
