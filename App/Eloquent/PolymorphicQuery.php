<?php

namespace App\Eloquent;

use App\Eloquent\Models\EmployeeTPC;
use App\Eloquent\Models\PermanentTPC;
use App\Interface\ORMDriver;
use App\Request;
use Illuminate\Database\Capsule\Manager as DB;
use Pecee\SimpleRouter\SimpleRouter;

class PolymorphicQuery extends Action implements ORMDriver
{
  public function create(): mixed
  {
    try {
      DB::beginTransaction();
      $employee = EmployeeTPC::create([
        'name' => Request::input('name'),
        'address' => Request::input('address'),
        'type' => 'permanent'
      ]);

      PermanentTPC::create([
        'id' => $employee->id,
        'nik' => Request::input('nik'),
        'contract_duration' => null,
      ]);
      DB::commit();
      return SimpleRouter::response()->json(['employee' => $employee->loadMissing('employment')]);
    } catch (\Throwable $th) {
      DB::rollBack();
      return SimpleRouter::response()->json(['message' => $th->getMessage()]);
    }
  }

  public function read(): mixed
  {
    return SimpleRouter::response()->json(['employees' => EmployeeTPC::all()]);
  }

  public function update(int $id): mixed
  {
    try {
      DB::beginTransaction();
      $object = PermanentTPC::with('employment')->find($id);
      $object->fill([
        'nik' => Request::input('nik'),
        'contract_duration' => null,
      ]);
      $object->employment->name = Request::input('name');
      $object->push();
      DB::commit();
      return SimpleRouter::response()->json(['object' => $object]);
    } catch (\Throwable $th) {
      DB::rollBack();
      return SimpleRouter::response()->json(['message' => $th->getMessage()]);
    }
  }

  public function destroy(int $id): mixed
  {
    try {
      DB::beginTransaction();
      $employee = EmployeeTPC::find($id);
      $employee->employment()->delete();
      $employee->delete();
      DB::commit();
      return SimpleRouter::response()->json(['message' => 'OK']);
    } catch (\Throwable $th) {
      DB::rollBack();
      return SimpleRouter::response()->json(['message' => $th->getMessage()]);
    }
  }

  public function lookup(int $id): mixed
  {
    return EmployeeTPC::with('employment')->find($id);
  }
}
