<?php

namespace App\Doctrine\Repositories;

use App\Doctrine\Models\User;

class CRUDRepository extends Repository
{
    public function createOperation($data)
    {
        $user = new User;
        $user->init(
            name: $data['name'],
            email: $data['email'],
            password: password_hash("password", PASSWORD_DEFAULT)
        );
        $this->em->persist($user);
        $this->em->flush();

        return response()->json([
            'user' => $user->serialize()
        ]);
    }
    public function updateOperation($data, $id)
    {
        try {
            $user = $this->em->find(User::class, $id);
            $user->init(
                name: $data['name'],
                email: $data['email'],
                password: $user->password
            );
            $this->em->persist($user);
            $this->em->flush();

            return response()->json(['user' => $user->serialize()]);
        } catch (\Throwable $th) {
            return response()->json(['user' => $th->getMessage()]);
        }
    }
    public function deleteOperation($id)
    {
        $user = $this->em->find(User::class, $id);
        $this->em->remove($user);
        $this->em->flush();

        return response()->json([
            'user' => $user->serialize()
        ]);
    }
    public function readOperation()
    {
        $users = $this->em->getRepository(User::class)->findAll();
        return response()->json([
            'users' => $this->serializeCollection($users)
        ]);
    }
    public function lookupOperation($id)
    {
        /** @var User */
        $user = $this->em->find(User::class, $id);
        return response()->json([
            'user' => $user->serialize(withRelationship: true)
        ]);
    }
}
