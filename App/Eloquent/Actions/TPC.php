<?php

namespace App\Eloquent\Actions;

use App\Eloquent\Models\EmployeeTPC;
use App\Eloquent\Models\PermanentTPC;
use App\Interface\ORMDriver;
use Illuminate\Support\Facades\DB;

class TPC implements ORMDriver
{
  public function create(array $data): mixed
  {
    try {
      DB::beginTransaction();
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
      return json_encode(['employee' => $employee->loadMissing('employment')]);
    } catch (\Throwable $th) {
      DB::rollBack();
      return json_encode(['message' => $th->getMessage()]);
    }
  }

  public function read(): mixed
  {
    return json_encode(['employees' => EmployeeTPC::all()]);
  }

  public function update(int $id, array $data): mixed
  {
    try {
      DB::beginTransaction();
      $object = PermanentTPC::with('employment')->find($id);
      $object->fill(['nik' => $data['nik'], 'contract_duration' => null]);
      $object->employment->name = $data['name'];
      $object->push();
      DB::commit();
      return json_encode(['object' => $object]);
    } catch (\Throwable $th) {
      DB::rollBack();
      return json_encode(['message' => $th->getMessage()]);
    }
  }

  public function delete(int $id): mixed
  {
    try {
      DB::beginTransaction();
      $employee = EmployeeTPC::find($id);
      $employee->employment()->delete();
      $employee->delete();
      DB::commit();
      return json_encode(['message' => 'OK']);
    } catch (\Throwable $th) {
      DB::rollBack();
      return json_encode(['message' => $th->getMessage()]);
    }
  }

  public function lookup(int $id): mixed
  {
    return EmployeeTPC::with('employment')->find($id);
  }
}
