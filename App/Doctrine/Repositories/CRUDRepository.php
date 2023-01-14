<?php

namespace App\Doctrine\Repositories;

use App\Doctrine\Models\User;

class CRUDRepository extends Repository
{
    public function createOperation()
    {
        $user = new User;
        $user->init(
            name: $this->faker->name,
            email: $this->faker->uuid . '@example.com',
            password: $this->faker->password()
        );
        $this->em->persist($user);
        $this->em->flush();

        return response()->json([
            'user' => $user->serialize()
        ]);
    }
    public function updateOperation()
    {
        $user = $this->randomEntity(User::class);
        $user->init(
            name: $this->faker->name,
            email: $this->faker->uuid . '@example.com',
            password: $this->faker->password()
        );
        $this->em->persist($user);
        $this->em->flush();

        return response()->json([
            'user' => $user->serialize()
        ]);
    }
    public function deleteOperation()
    {
        $user = $this->randomEntity(User::class);
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
    public function lookupOperation()
    {
        /** @var User */
        $user = $this->randomEntity(User::class);
        return response()->json([
            'user' => $user->serialize(withRelationship: true)
        ]);
    }
}
