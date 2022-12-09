<?php
namespace App\Eloquent\Repositories;

use App\Eloquent\Models\EmployeeTPC;
use App\Eloquent\Repositories\Repository;
use Illuminate\Support\Facades\DB;

class PolymorphicTPCRepository extends Repository
{
    private const TYPES = ['permanent', 'contract'];
    public function createOperation()
    {
        try {
            DB::beginTransaction();
            $selectedEmployeeType = array_rand(self::TYPES, 1);
            $employee = EmployeeTPC::create([
                'name' => 'Employee Name',
                'address' => 'Employee Address',
                'type' => $selectedEmployeeType
            ]);
            $employee->employment()->create([
                'nik' => 'Employee NIK',
                'contract_duration' => 1
            ]);
            DB::commit();
            $employee->refresh();
            return response()->json([
                'employee' => $employee
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'employee' => $th->getMessage()
            ]);
        }
    }
    public function readOperation()
    {
        return response()->json([
            'employee' => EmployeeTPC::all()
        ]);
    }
    public function updateOperation()
    {
        try {
            DB::beginTransaction();
            $employee = EmployeeTPC::inRandomOrder()->first();
            $employee->fill(['name' => 'Updated Employee Name']);
            $employee->saveOrFail();
            $employee->employment()->fill(['nik' => '987654321', 'contract_duration' => 2]);
            $employee->employment()->saveOrFail();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'employee' => $th->getMessage()
            ]);
        }
    }
    public function deleteOperation()
    {
        try {
            DB::beginTransaction();
            $employee = EmployeeTPC::inRandomOrder()->first();
            $employee->employment()->delete();
            $employee->delete();
            DB::commit();
            return response()->json([
                'employee' => $employee
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'employee' => $th->getMessage()
            ]);
        }
    }
    public function lookupOperation()
    {
        return response()->json([
            'employee' => EmployeeTPC::inRandomOrder()->with('employment')->first()
        ]);
    }
}
