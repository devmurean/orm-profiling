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
        $result = [];
        foreach ($users as $user) {
            $result[] = $user->serialize();
        }
        return response()->json([
            'users' => $result
        ]);
    }
    public function lookupOperation()
    {
        /** @var User */
        $user = $this->em->find(User::class, 1);
        return response()->json([
            'user' => $user->serialize(withRelationship: false)
        ]);
    }
}
