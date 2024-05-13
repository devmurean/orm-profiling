<?php

namespace App\Eloquent;

use App\Eloquent\Models\EmployeeTPCC;
use App\Eloquent\Models\PermanentTPCC;
use App\Interface\ORMDriver;
use App\Request;
use Illuminate\Database\Capsule\Manager as DB;
use Pecee\SimpleRouter\SimpleRouter;

class TPCC extends Action implements ORMDriver
{
  public function create(): mixed
  {
    try {
      DB::beginTransaction();
      $data = [
        'type' => 'permanent',
        'name' => Request::input('name'),
        'address' => Request::input('address'),
        'nik' => Request::input('nik'),
        'contract_duration' => null,
      ];
      $result = [
        'employee' => EmployeeTPCC::create($data),
        'permanent' => PermanentTPCC::create($data)
      ];
      DB::commit();
      return SimpleRouter::response()->json($result);
    } catch (\Throwable $th) {
      DB::rollBack();
      return SimpleRouter::response()->json(['message' => $th->getMessage()]);
    }
  }

  public function read(): mixed
  {
    return SimpleRouter::response()->json(['employees' => EmployeeTPCC::all()]);
  }

  public function update(int $id): mixed
  {
    try {
      DB::beginTransaction();
      $object = EmployeeTPCC::find($id);
      $object->fill([
        'name' => Request::input('name'),
        'address' => Request::input('address'),
      ]);
      $object->saveOrFail();
      DB::commit();
      return SimpleRouter::response()->json(['employee' => $object]);
    } catch (\Throwable $th) {
      DB::rollBack();
      return SimpleRouter::response()->json(['message' => $th->getMessage()]);
    }
  }

  public function destroy(int $id): mixed
  {
    try {
      DB::beginTransaction();
      $object = EmployeeTPCC::find($id);
      $object->delete();
      DB::commit();
      return SimpleRouter::response()->json(['message' => 'OK']);
    } catch (\Throwable $th) {
      DB::rollBack();
      return SimpleRouter::response()->json(['message' => $th->getMessage()]);
    }
  }

  public function lookup(int $id): mixed
  {
    return SimpleRouter::response()->json(['employee' => EmployeeTPCC::find($id)]);
  }
}
