<?php
namespace App\Eloquent\Repositories;

use App\Eloquent\Models\ContractTPCC;
use App\Eloquent\Models\EmployeeTPCC;
use App\Eloquent\Models\PermanentTPCC;
use App\Eloquent\Repositories\Repository;
use Illuminate\Support\Facades\DB;

class PolymorphicTPCCRepository extends Repository
{
    public function createOperation()
    {
        try {
            DB::beginTransaction();
            $data = [
                'type' => array_rand(['permanent', 'contract'], 1),
                'name' => 'Employee Name',
                'address' => 'Employee Address',
                'nik' => '123456789',
                'contract_duration' => 1
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
        $resource = array_rand(['permanent', 'contract', 'employee'], 1);
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
        $resource = array_rand(['permanent', 'contract', 'employee'], 1);
        $result = [];
        switch ($resource) {
            case 'permanent':
                $object = PermanentTPCC::inRandomOrder()->first();
                break;
            case 'contract':
                $object = ContractTPCC::inRandomOrder()->first();
                break;
            case 'employee':
                $object = EmployeeTPCC::inRandomOrder()->first();
                break;
        }

        $object->name = 'Updated ' . $resource . ' Name';
        $object->saveOrFail();
        $result[$resource] = $object;
        return response()->json($result);
    }
    public function deleteOperation()
    {
        $resource = array_rand(['permanent', 'contract', 'employee'], 1);
        $result = [];
        switch ($resource) {
            case 'permanent':
                $object = PermanentTPCC::inRandomOrder()->first();
                break;
            case 'contract':
                $object = ContractTPCC::inRandomOrder()->first();
                break;
            case 'employee':
                $object = EmployeeTPCC::inRandomOrder()->first();
                break;
        }
        $object->delete();
        $result[$resource] = $object;
        return response()->json($result);
    }
    public function lookupOperation()
    {
        $resource = array_rand(['permanent', 'contract', 'employee'], 1);
        $result = [];
        switch ($resource) {
            case 'permanent':
                $object = PermanentTPCC::inRandomOrder()->first();
                break;
            case 'contract':
                $object = ContractTPCC::inRandomOrder()->first();
                break;
            case 'employee':
                $object = EmployeeTPCC::inRandomOrder()->first();
                break;
        }
        $result[$resource] = $object;
        return response()->json($result);
    }
}
