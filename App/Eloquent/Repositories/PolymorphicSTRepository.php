<?php
namespace App\Eloquent\Repositories;

use App\Eloquent\Models\EmployeeST;
use App\Eloquent\Repositories\Repository;

class PolymorphicSTRepository extends Repository
{
    public function createOperation()
    {
        $fills = [
            'name' => $this->faker->name,
            'address' => $this->faker->address(),
            'nik' => rand(10000, 99999),
            'contract_duration' => null
        ];

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
            $employee = EmployeeST::find($this->randomId());
            $employee->fill([
                'name' => $this->faker->name,
                'address' => $this->faker->address
            ]);
            $employee->saveOrFail();
            return response()->json(['employee' => $employee]);
        } catch (\Throwable $th) {
            return response()->json(['employee' => $th->getMessage()]);
        }
    }
    public function deleteOperation()
    {
        /** @var EmployeeST */
        $employee = EmployeeST::find($this->randomId());
        $employee->delete();
        return response()->json([
            'employee' => $employee
        ]);
    }
    public function lookupOperation()
    {
        $employee = EmployeeST::find($this->randomId());
        return response()->json([ 'employee' => $employee ]);
    }
}
