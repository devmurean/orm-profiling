<?php
namespace App\Eloquent\Repositories;

use App\Eloquent\Models\ContractTPC;
use App\Eloquent\Models\EmployeeTPC;
use App\Eloquent\Models\PermanentTPC;
use App\Eloquent\Repositories\Repository;
use Illuminate\Support\Facades\DB;

class PolymorphicTPCRepository extends Repository
{
    private const TYPES = ['permanent', 'contract'];
    public function createOperation()
    {
        try {
            DB::beginTransaction();
            $selectedEmployeeType = array_rand([
                PermanentTPC::class,
                ContractTPC::class
            ], 1);

            /** @var EmployeeTPC */
            $employee = EmployeeTPC::create([
                'name' => $this->faker->name(),
                'address' => $this->faker->address,
                'type' => $selectedEmployeeType
            ]);

            $employee->employment()->create([
                'nik' => rand(10**5, 10**6-1),
                'contract_duration' => rand(1, 5)
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
            $employee->fill(['name' => $this->faker->name]);
            $employee->saveOrFail();
            $employee->employment()->fill([
                'nik' => rand(10**5, 10**6-1),
                'contract_duration' => rand(1, 5)
            ]);
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
