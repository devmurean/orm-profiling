<?php
namespace App\Eloquent\Repositories;

use App\Eloquent\Models\ContractTPCC;
use App\Eloquent\Models\EmployeeTPCC;
use App\Eloquent\Models\PermanentTPCC;
use App\Eloquent\Repositories\Repository;
use Illuminate\Database\Capsule\Manager as DB;

class PolymorphicTPCCRepository extends Repository
{
    public function createOperation()
    {
        try {
            DB::beginTransaction();
            $data = [
                'type' => 'permanent',
                'name' => $this->faker->name,
                'address' => $this->faker->address,
                'nik' => rand(10**5, 10**6-1),
                'contract_duration' => rand(1, 5)
            ];
            $result = [
                'employee' => EmployeeTPCC::create($data),
                'permanent' => PermanentTPCC::create($data)
            ];
            DB::commit();

            return response()->json($result);
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
    public function readOperation()
    {
        return response()->json(['employee' => EmployeeTPCC::all()]);
    }
    public function updateOperation()
    {
        $object = EmployeeTPCC::find($this->randomId());
        $object->name = $this->faker->name;
        $object->saveOrFail();
        return response()->json(['employee' => $object]);
    }
    public function deleteOperation()
    {
        $object = EmployeeTPCC::find($this->randomId());
        $object->delete();
        return response()->json(['employee' => $object]);
    }
    public function lookupOperation()
    {
        return response()->json(['employee' => EmployeeTPCC::find($this->randomId())]);
    }
}
