<?php

namespace App\Eloquent\Actions;

use App\Eloquent\Models\EmployeeST;
use App\Interface\ORMDriver;
use Illuminate\Support\Facades\DB;

class ST implements ORMDriver
{
  public function create(array $data): mixed
  {
    try {
      DB::beginTransaction();
      $employee = EmployeeST::create([
        'name' => $data['name'],
        'address' => $data['address'],
        'nik' => $data['nik'],
        'contract_duration' => $data['contract_duration']
      ]);
      DB::commit();
      return json_encode(['employee' => $employee]);
    } catch (\Throwable $th) {
      DB::rollBack();
      return json_encode(['message' => $th->getMessage()]);
    }
  }

  public function read(): mixed
  {
    return json_encode(['employees' => EmployeeST::all()]);
  }

  public function update(int $id, array $data): mixed
  {
    try {
      DB::beginTransaction();
      $employee = EmployeeST::find($id);
      $employee->fill(['name' => $data['name'], 'address' => $data['address']]);
      $employee->saveOrFail();
      DB::commit();
      return json_encode(['employee' => $employee]);
    } catch (\Throwable $th) {
      DB::rollBack();
      return json_encode(['message' => $th->getMessage()]);
    }
  }

  public function delete(int $id): mixed
  {
    try {
      DB::beginTransaction();
      $employee = EmployeeST::find($id);
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
    return json_encode(['employee' => EmployeeST::find($id)]);
  }
}
