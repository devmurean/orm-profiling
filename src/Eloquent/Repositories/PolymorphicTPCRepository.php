<?php
namespace App\Eloquent\Repositories;

use App\Eloquent\Models\ContractTPC;
use App\Eloquent\Models\EmployeeTPC;
use App\Eloquent\Models\PermanentTPC;
use App\Eloquent\Repositories\Repository;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Eloquent\Model;

class PolymorphicTPCRepository extends Repository
{
    public function createOperation()
    {
        DB::beginTransaction();
        $selectedEmployeeType = $this->faker->randomElement([
            PermanentTPC::class, ContractTPC::class
        ]);

        $fill = [
            'nik' => rand(10**5, 10**6-1),
            'contract_duration' => rand(1, 5)
        ];

        /** @var EmployeeTPC */
        $employee = EmployeeTPC::create([
            'name' => $this->faker->name(),
            'address' => $this->faker->address,
            'type' => $selectedEmployeeType
        ]);

        $fill = [
            'employee_tpc_id' => $employee->id,
            'nik' => rand(10**5, 10**6-1),
            'contract_duration' => rand(1, 5)
        ];

        ($selectedEmployeeType === PermanentTPC::class)
            ? PermanentTPC::create($fill)
            : ContractTPC::create($fill);
       
        DB::commit();

        return response()->json([
            'employee' => $employee->loadMissing('employment')
        ]);
    }

    public function readOperation()
    {
        return response()->json([
            'employee' => EmployeeTPC::all()
        ]);
    }
    
    public function updateOperation()
    {
        DB::beginTransaction();
        $selectedEmployeeType = $this->faker->randomElement([
            PermanentTPC::class, ContractTPC::class
        ]);

        $object = ($selectedEmployeeType === PermanentTPC::class)
            ? PermanentTPC::inRandomOrder()->first()
            : ContractTPC::inRandomOrder()->first();
        
        $object->fill([
            'nik' => rand(10**5, 10**6-1),
            'contract_duration' => rand(1, 5)
        ]);
        $object->employment->name = $this->faker->name;
        $object->push();
        DB::commit();
        return response()->json([
            'object' => $object,
        ]);
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
