<?php

namespace App\Eloquent\Repositories;

use App\Eloquent\Models\EmployeeST;
use App\Eloquent\Repositories\Repository;

class PolymorphicSTRepository extends Repository
{
    public function createOperation($data)
    {
        $fills = [
            'name' => $data['name'],
            'address' => $data['address'],
            'nik' => $data['nik'],
            'contract_duration' => $data['contract_duration']
        ];

        $employee = EmployeeST::create($fills);
        return response()->json(['employee' => $employee]);
    }

    public function readOperation()
    {
        $employees = EmployeeST::all();
        return response()->json(['employee' => $employees]);
    }

    public function updateOperation($data, $id)
    {
        try {
            /** @var EmployeeST */
            $employee = EmployeeST::find($id);
            $employee->fill([
                'name' => $data['name'],
                'address' => $data['address']
            ]);
            $employee->saveOrFail();
            return response()->json(['employee' => $employee]);
        } catch (\Throwable $th) {
            return response()->json(['employee' => $th->getMessage()]);
        }
    }
    public function deleteOperation($id)
    {
        /** @var EmployeeST */
        $employee = EmployeeST::find($id);
        $employee->delete();
        return response()->json(['employee' => $employee]);
    }
    public function lookupOperation($id)
    {
        $employee = EmployeeST::find($id);
        return response()->json(['employee' => $employee]);
    }
}
