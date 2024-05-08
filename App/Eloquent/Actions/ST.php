<?php

namespace App\Eloquent\Actions;

use App\Eloquent\Models\EmployeeST;
use App\Interface\ORMDriver;
use App\Request;
use Illuminate\Database\Capsule\Manager as DB;
use Pecee\SimpleRouter\SimpleRouter;

class ST extends Action implements ORMDriver
{
  public function create(): mixed
  {
    try {
      DB::beginTransaction();
      $employee = EmployeeST::create([
        'name' => Request::input('name'),
        'address' => Request::input('address'),
        'nik' => Request::input('nik'),
        'contract_duration' => Request::input('contract_duration')
      ]);
      DB::commit();
      return SimpleRouter::response()->json(['employee' => $employee]);
    } catch (\Throwable $th) {
      DB::rollBack();
      return SimpleRouter::response()->json(['message' => $th->getMessage()]);
    }
  }

  public function read(): mixed
  {
    return SimpleRouter::response()->json(['employees' => EmployeeST::all()]);
  }

  public function update(int $id): mixed
  {
    try {
      DB::beginTransaction();
      $employee = EmployeeST::find($id);
      $employee->fill([
        'name' => Request::input('name'),
        'address' => Request::input('address'),
      ]);
      $employee->saveOrFail();
      DB::commit();
      return SimpleRouter::response()->json(['employee' => $employee]);
    } catch (\Throwable $th) {
      DB::rollBack();
      return SimpleRouter::response()->json(['message' => $th->getMessage()]);
    }
  }

  public function destroy(int $id): mixed
  {
    try {
      DB::beginTransaction();
      $employee = EmployeeST::find($id);
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
    return SimpleRouter::response()->json(['employee' => EmployeeST::find($id)]);
  }
}
