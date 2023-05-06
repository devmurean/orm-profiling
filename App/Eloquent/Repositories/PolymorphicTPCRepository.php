<?php

namespace App\Eloquent\Repositories;

use App\Eloquent\Models\ContractTPC;
use App\Eloquent\Models\EmployeeTPC;
use App\Eloquent\Models\PermanentTPC;
use App\Eloquent\Repositories\Repository;
use Illuminate\Database\Capsule\Manager as DB;

class PolymorphicTPCRepository extends Repository
{
    public function createOperation($data)
    {
        DB::beginTransaction();
        // $selectedEmployeeType = $this->faker->randomElement([
        //     PermanentTPC::class, ContractTPC::class
        // ]);

        /** @var EmployeeTPC */
        $employee = EmployeeTPC::create([
            'name' => $data['name'],
            'address' => $data['address'],
            'type' => 'permanent'
        ]);
        PermanentTPC::create([
            'id' => $employee->id,
            'nik' => $data['nik'],
            'contract_duration' => null
        ]);

        DB::commit();

        return response()->json([
            'employee' => $employee->loadMissing('employment')
        ]);
    }

    public function readOperation()
    {
        return response()->json(['employee' => EmployeeTPC::all()]);
    }

    public function updateOperation($data, $id)
    {
        DB::beginTransaction();
        $object = PermanentTPC::with('employment')->find($id);

        $object->fill([
            'nik' => $data['nik'],
            'contract_duration' => null
        ]);
        $object->employment->name = $data['name'];
        $object->push();
        DB::commit();
        return response()->json(['object' => $object,]);
    }
    public function deleteOperation($id)
    {
        try {
            DB::beginTransaction();
            $employee = EmployeeTPC::find($id);
            $employee->employment()->delete();
            $employee->delete();
            DB::commit();
            return response()->json(['employee' => $employee]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['employee' => $th->getMessage()]);
        }
    }
    public function lookupOperation($id)
    {
        return response()->json([
            'employee' => EmployeeTPC::with('employment')->find($id)
        ]);
    }
}
