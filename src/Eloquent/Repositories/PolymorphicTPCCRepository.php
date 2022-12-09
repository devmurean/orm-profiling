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
    }
    public function updateOperation()
    {
    }
    public function deleteOperation()
    {
    }
    public function lookupOperation()
    {
    }
}
