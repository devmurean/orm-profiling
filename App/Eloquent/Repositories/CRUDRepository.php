<?php

namespace App\Eloquent\Repositories;

use App\Eloquent\Models\User;

class CRUDRepository extends Repository
{
    public function createOperation()
    {
        $user = User::create([
            'name' => $this->faker->name,
            'email' => $this->faker->uuid . '@example.com',
            'password' => $this->faker->password()
        ]);
        return response()->json([
            'user' => $user
        ]);
    }

    public function readOperation()
    {
        $users = User::all();
        return response()->json([
            'user' => $users
        ]);
    }

    public function updateOperation()
    {
        try {
            $user = User::find($this->randomId());
            $user->name = $this->faker->name;
            $user->saveOrFail();

            return response()->json([
                'user' => $user
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'user' => $th->getMessage()
            ]);
        }
    }

    public function deleteOperation()
    {
        $user = User::find($this->randomId());
        $user->delete();
        return response()->json([
            'user' => $user
        ]);
    }

    public function lookupOperation()
    {
        $user = User::with(['task', 'role', 'desk'])->find($this->randomId());
        return response()->json([
            'user' => $user
        ]);
    }
}
