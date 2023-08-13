<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class CustomerExport implements FromCollection
{
    /**
     * Get the customers' data.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $customers = User::with(['roles' => function ($query) {
            $query->whereIn('name', array('Customer'));
        }])
            ->withTrashed()
            ->whereHas('roles', function ($query) {
                $query->whereIn('name', array('Customer'));
            })
            ->get();

        $headers = ['Name', 'Employee Id', 'Email', 'Gender', 'DOB', 'Phone', 'Address', 'Status'];

        $customersData = $customers->map(function ($customer) {
            return [
                'Name' => $customer->name,
                'Employee Id' => $customer->unique_id,
                'Email' => $customer->email,
                'Gender' => $customer->gender,
                'DOB' => $customer->dob,
                'Phone' => $customer->phone,
                'Address' => $customer->address,
                'Status' => $customer->status
            ];
        });

        return $customersData;
    }
}
