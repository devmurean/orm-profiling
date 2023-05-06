<?php

namespace App\Eloquent\Repositories;

use App\Eloquent\Models\User;

class CRUDRepository extends Repository
{
    public function createOperation($data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => password_hash("password", PASSWORD_DEFAULT)
        ]);
        return response()->json([
            'user' => $user
        ]);
    }

    public function readOperation()
    {
        return response()->json(['user' => User::all()]);
    }

    public function updateOperation($data, $id)
    {
        try {
            $user = User::find($id);
            $user->fill([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $user->password,
            ]);
            $user->saveOrFail();

            return response()->json(['user' => $user]);
        } catch (\Throwable $th) {
            return response()->json(['user' => $th->getMessage()]);
        }
    }

    public function deleteOperation($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(['user' => $user]);
    }

    public function lookupOperation($id)
    {
        $user = User::with(['task', 'role', 'desk'])->find($id);
        return response()->json([
            'user' => $user
        ]);
    }
}
