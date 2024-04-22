<?php

namespace App\Eloquent\Actions;

use App\Eloquent\Models\User;
use App\Interface\ORMDriver;
use Illuminate\Support\Facades\DB;

class CRUD implements ORMDriver
{
  public function create(array $data): mixed
  {
    try {
      DB::beginTransaction();
      $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => password_hash("password", PASSWORD_DEFAULT)
      ]);
      DB::commit();
      return json_encode(['user' => $user]);
    } catch (\Throwable $th) {
      DB::rollBack();
      return json_encode(['message' => $th->getMessage()]);
    }
  }

  public function read(): mixed
  {
    return json_encode(['users' => User::all()]);
  }

  public function update(int $id, array $data): mixed
  {
    try {
      DB::beginTransaction();
      $user = User::find($id);
      $user->fill(['name' => $data['name'], 'email' => $data['email']]);
      $user->saveOrFail();
      DB::commit();
      return json_encode(['user' => $user]);
    } catch (\Throwable $th) {
      DB::rollBack();
      return json_encode(['message' => $th->getMessage()]);
    }
  }

  public function delete(int $id): mixed
  {
    try {
      DB::beginTransaction();
      $user = User::find($id);
      $user->delete();
      DB::commit();
      return json_encode(['message' => 'OK']);
    } catch (\Throwable $th) {
      DB::rollBack();
      return json_encode(['message' => $th->getMessage()]);
    }
  }

  public function lookup(int $id): mixed
  {
    $user = User::with(['task', 'role', 'desk'])->find($id);
    return json_encode(['user' => $user]);
  }
}
