<?php
namespace App\Eloquent\Repositories;

use App\Eloquent\Models\EmployeeST;
use App\Eloquent\Repositories\Repository;

class PolymorphicSTRepository extends Repository
{
    private const TYPES = ['permanent', 'contract'];
    public function createOperation()
    {
        $selectedEmployeeType = array_rand(self::TYPES, 1);
        $fills = [
            'name' => 'Employee Name',
            'address' => 'Employee Address',
        ];
        if ($selectedEmployeeType === 'permanent') {
            $fills['nik'] = '123456789';
        } else {
            $fills['contract_duration'] = 1;
        }
        $employee = EmployeeST::create($fills);
        return response()->json([ 'employee' => $employee ]);
    }
    public function readOperation()
    {
        $employees = EmployeeST::all();
        return response()->json([ 'employee' => $employees ]);
    }
    public function updateOperation()
    {
        try {
            /** @var EmployeeST */
            $employee = EmployeeST::inRandomOrder()->first();
            $employee->fill([
                'name' => 'Updated Employee Name',
                'address' => 'Updated Employee Address'
            ]);
            $employee->saveOrFail();
            return response()->json([ 'employee' => $employee ]);
        } catch (\Throwable $th) {
            return response()->json(['employee' => $th->getMessage()]);
        }
    }
    public function deleteOperation()
    {
        /** @var EmployeeST */
        $employee = EmployeeST::inRandomOrder()->first();
        $employee->delete();
        return response()->json([
            'employee' => $employee
        ]);
    }
    public function lookupOperation()
    {
        $employee = EmployeeST::inRandomOrder()->first();
        return response()->json([ 'employee' => $employee ]);
    }
}
