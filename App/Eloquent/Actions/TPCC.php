<?php

namespace App\Eloquent\Actions;

use App\Eloquent\Models\EmployeeTPCC;
use App\Eloquent\Models\PermanentTPCC;
use App\Interface\ORMDriver;
use Illuminate\Database\Capsule\Manager as DB;

class TPCC extends Action implements ORMDriver
{
  public function create(array $data): mixed
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
      return json_encode($result);
    } catch (\Throwable $th) {
      DB::rollBack();
      return json_encode(['message' => $th->getMessage()]);
    }
  }

  public function read(): mixed
  {
    return json_encode(['employees' => EmployeeTPCC::all()]);
  }

  public function update(int $id, array $data): mixed
  {
    try {
      DB::beginTransaction();
      $object = EmployeeTPCC::find($id);
      $object->name = $data['name'];
      $object->saveOrFail();
      DB::commit();
      return json_encode(['employee' => $object]);
    } catch (\Throwable $th) {
      DB::rollBack();
      return json_encode(['message' => $th->getMessage()]);
    }
  }

  public function delete(int $id): mixed
  {
    try {
      DB::beginTransaction();
      $object = EmployeeTPCC::find($id);
      $object->delete();
      DB::commit();
      return json_encode(['message' => 'OK']);
    } catch (\Throwable $th) {
      DB::rollBack();
      return json_encode(['message' => $th->getMessage()]);
    }
  }

  public function lookup(int $id): mixed
  {
    return json_encode(['employee' => EmployeeTPCC::find($id)]);
  }
}
