<?php
namespace App\Eloquent\Repositories;

use App\Eloquent\Models\EmployeeST;
use App\Eloquent\Repositories\Repository;

class PolymorphicSTRepository extends Repository
{
    public function createOperation()
    {
        $selectedEmployeeType = array_rand([
            'permanent', 'contract'
        ], 1);

        $fills = [
            'name' => $this->faker->name,
            'address' => $this->faker->address(),
            'nik' => $selectedEmployeeType === 'permanent' ? rand(10000, 99999) : null,
            'contract_duration' => $selectedEmployeeType === 'contract' ? rand(1, 5) : null
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
            $employee = EmployeeST::inRandomOrder()->first();
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
