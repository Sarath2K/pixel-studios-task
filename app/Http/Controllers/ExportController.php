<?php

namespace App\Http\Controllers;

use App\Exports\CustomerExport;
use App\Exports\EmployeeExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportController extends Controller
{
    /**
     * Generate the employees details in xlsx file.
     *
     * @param Request $request
     * @return BinaryFileResponse
     */
    public function exportEmployees(Request $request)
    {
        return Excel::download(new EmployeeExport(), 'employee.xlsx');
    }

    /**
     * Generate the customers details in xlsx file.
     *
     * @param Request $request
     * @return BinaryFileResponse
     */
    public function exportCustomers(Request $request)
    {
        return Excel::download(new CustomerExport(), 'customer.xlsx');
    }
}
