<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployeeExport implements FromCollection
{
    /**
     * Get the employees' data.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $employees = User::with(['roles' => function ($query) {
            $query->whereIn('name', array('Manager', 'Sales Executive'));
        }])
            ->withTrashed()
            ->whereHas('roles', function ($query) {
                $query->whereIn('name', array('Manager', 'Sales Executive'));
            })
            ->get();

        $headers = ['Name', 'Employee Id', 'Designation', 'Email', 'Gender', 'DOB', 'Phone', 'Address', 'Status'];

        $employeesData = $employees->map(function ($employee) {
            $role = $employee->roles;
            return [
                'Name' => $employee->name,
                'Employee Id' => $employee->unique_id,
                'Designation' => $role[0]['name'],
                'Email' => $employee->email,
                'Gender' => $employee->gender,
                'DOB' => $employee->dob,
                'Phone' => $employee->phone,
                'Address' => $employee->address,
                'Status' => $employee->status
            ];
        });

        return $employeesData;
    }
}
