<?php

namespace App\Doctrine\Repositories;

use App\Doctrine\Models\User;

class CRUDRepository extends Repository
{
    public function createOperation()
    {
    }
    public function updateOperation()
    {
    }
    public function deleteOperation()
    {
    }
    public function readOperation()
    {
        $users = $this->em->getRepository(User::class)->findAll();
        return response()->json([
            'users' => $users
        ]);
    }
    public function lookupOperation()
    {
        $user = $this->em->getRepository(User::class)->find(1);
        return response()->json([
            'user' => $user
        ]);
    }
}
