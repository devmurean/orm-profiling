<?php

namespace App\Doctrine\Actions;

use App\Doctrine\EM;
use App\Doctrine\Helpers\ModelCollection;
use App\Doctrine\Models\User;
use App\Interface\ORMDriver;

class CRUD implements ORMDriver
{
  public function create(array $data): mixed
  {
    try {
      $user = new User;
      $user->init(
        name: $data['name'],
        email: $data['email'],
        password: password_hash("password", PASSWORD_DEFAULT)
      );
      $em = EM::make();
      $em->persist($user);
      $em->flush();
      return json_encode(['user' => $user->serialize()]);
    } catch (\Throwable $th) {
      return json_encode(['message' => $th->getMessage()]);
    }
  }

  public function read(): mixed
  {
    return json_encode(['users' => ModelCollection::serialize(
      EM::make()->getRepository(User::class)->findAll()
    )]);
  }

  public function update(int $id, array $data): mixed
  {
    try {
      $em = EM::make();
      $user = $em->find(User::class, $id);
      $user->init(
        name: $data['name'],
        email: $data['email'],
        password: $user->password
      );
      $em->persist($user);
      $em->flush();
      return json_encode(['user' => $user->serialize()]);
    } catch (\Throwable $th) {
      return json_encode(['message' => $th->getMessage()]);
    }
  }

  public function delete(int $id): mixed
  {
    try {
      $em = EM::make();
      $user = $em->find(User::class, $id);
      $em->remove($user);
      $em->flush();
      return json_encode(['message' => 'OK']);
    } catch (\Throwable $th) {
      return json_encode(['message' => $th->getMessage()]);
    }
  }
  public function lookup(int $id): mixed
  {
    return json_encode([
      'user' => EM::make()->find(User::class, $id)->serialize(true)
    ]);
  }
}
