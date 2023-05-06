<?php

namespace App\Eloquent\Repositories;

use App\Eloquent\Models\ContractTPCC;
use App\Eloquent\Models\EmployeeTPCC;
use App\Eloquent\Models\PermanentTPCC;
use App\Eloquent\Repositories\Repository;
use Illuminate\Database\Capsule\Manager as DB;

class PolymorphicTPCCRepository extends Repository
{
    public function createOperation($data)
    {
        try {
            DB::beginTransaction();
            $data = [
                'type' => 'permanent',
                'name' => $data['name'],
                'address' => $data['address'],
                'nik' => $data['nik'],
                'contract_duration' => null
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
    public function updateOperation($data, $id)
    {
        $object = EmployeeTPCC::find($id);
        $object->name = $data['name'];
        $object->saveOrFail();
        return response()->json(['employee' => $object]);
    }
    public function deleteOperation($id)
    {
        $object = EmployeeTPCC::find($id);
        $object->delete();
        return response()->json(['employee' => $object]);
    }
    public function lookupOperation($id)
    {
        return response()->json(['employee' => EmployeeTPCC::find($id)]);
    }
}
