<?php

namespace App\Eloquent\Actions;

use App\Eloquent\Models\User;
use App\Interface\ORMDriver;
use App\Request;
use Illuminate\Database\Capsule\Manager as DB;
use Pecee\SimpleRouter\SimpleRouter;

class CRUD extends Action implements ORMDriver
{
  public function create(): mixed
  {
    try {
      DB::beginTransaction();
      $user = User::create([
        'name' => Request::input('name'),
        'email' => Request::input('email'),
        'password' => "password"
      ]);
      DB::commit();
      return SimpleRouter::response()->json(['user' => $user]);
    } catch (\Throwable $th) {
      DB::rollBack();
      return SimpleRouter::response()->json(['message' => $th->getMessage()]);
    }
  }

  public function read(): mixed
  {
    return SimpleRouter::response()->json(['users' => User::all()]);
  }

  public function update(int $id): mixed
  {
    try {
      DB::beginTransaction();
      $user = User::find($id);
      $user->fill(['name' => Request::input('name'), 'email' => Request::input('email')]);
      $user->saveOrFail();
      DB::commit();
      return SimpleRouter::response()->json(['user' => $user]);
    } catch (\Throwable $th) {
      DB::rollBack();
      return SimpleRouter::response()->json(['message' => $th->getMessage()]);
    }
  }

  public function destroy(int $id): mixed
  {
    try {
      DB::beginTransaction();
      $user = User::find($id);
      $user->delete();
      DB::commit();
      return SimpleRouter::response()->json(['message' => 'OK']);
    } catch (\Throwable $th) {
      DB::rollBack();
      return SimpleRouter::response()->json(['message' => $th->getMessage()]);
    }
  }

  public function lookup(int $id): mixed
  {
    $user = User::with(['task', 'role', 'desk'])->find($id);
    return SimpleRouter::response()->json(['user' => $user]);
  }
}
