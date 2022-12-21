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
                'type' => array_rand(['permanent', 'contract'], 1),
                'name' => $this->faker->name,
                'address' => $this->faker->address,
                'nik' => rand(10**5, 10**6-1),
                'contract_duration' => rand(1, 5)
            ];
            $result = [
                'employee' => EmployeeTPCC::create($data)
            ];
            if ($data['type'] === 'permanent') {
                $result['permanent'] = PermanentTPCC::create($data);
            } else {
                $result['contract'] = ContractTPCC::create($data);
            }
            DB::commit();

            return response()->json($result);
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
    public function readOperation()
    {
        $resource = $this->faker->randomElement(['permanent', 'contract', 'employee']);
        $result = [];
        switch ($resource) {
            case 'permanent':
                $result[$resource] = PermanentTPCC::all();
                break;
            case 'contract':
                $result[$resource] = ContractTPCC::all();
                break;
            case 'employee':
                $result[$resource] = EmployeeTPCC::all();
                break;
        }
        return response()->json($result);
    }
    public function updateOperation()
    {
        $resource = $this->faker->randomElement(['permanent', 'contract', 'employee']);
        $result = [];
        $object = null;
        switch ($resource) {
            case 'permanent':
                $object = PermanentTPCC::find($this->randomId(max: 5000));
                break;
            case 'contract':
                $object = ContractTPCC::find($this->randomId(max: 5000));
                break;
            case 'employee':
                $object = EmployeeTPCC::find($this->randomId(max: 10000));
                break;
        }
        $object->name = $this->faker->name;
        $object->saveOrFail();
        $result[$resource] = $object;
        return response()->json($result);
    }
    public function deleteOperation()
    {
        $resource = $this->faker->randomElement(['permanent', 'contract', 'employee']);
        $object = null;
        $result = [];
        switch ($resource) {
            case 'permanent':
                $object = PermanentTPCC::find($this->randomId(max: 5000));
                break;
            case 'contract':
                $object = ContractTPCC::find($this->randomId(max: 5000));
                break;
            case 'employee':
                $object = EmployeeTPCC::find($this->randomId(max: 10000));
                break;
        }
        $object->delete();
        $result[$resource] = $object;
        return response()->json($result);
    }
    public function lookupOperation()
    {
        $resource = $this->faker->randomElement(['permanent', 'contract', 'employee']);
        $object = null;
        switch ($resource) {
            case 'permanent':
                $object = PermanentTPCC::find($this->randomId(max: 5000));
                break;
            case 'contract':
                $object = ContractTPCC::find($this->randomId(max: 5000));
                break;
            case 'employee':
                $object = EmployeeTPCC::find($this->randomId(max: 10000));
                break;
        }
        $result[$resource] = $object;
        return response()->json($result);
    }
}
