<?php

namespace App\Doctrine\Actions;

use App\Doctrine\EM;
use App\Doctrine\Helpers\ModelCollection;
use App\Doctrine\Models\User;
use App\Interface\ORMDriver;
use App\Request;
use Pecee\SimpleRouter\SimpleRouter;

class CRUD extends Action implements ORMDriver
{
  public function create(): mixed
  {
    try {
      $user = new User;
      $user->init(
        name: Request::input('name'),
        email: Request::input('email'),
        password: "password"
      );
      $em = EM::make();
      $em->persist($user);
      $em->flush();
      SimpleRouter::response()->json(['user' => $user->serialize()]);
    } catch (\Throwable $th) {
      return SimpleRouter::response()->json(['message' => $th->getMessage()]);
    }
  }

  public function read(): mixed
  {
    header("Content-Type: application/json");
    echo SimpleRouter::response()->json(['users' => ModelCollection::serialize(
      EM::make()->getRepository(User::class)->findAll()
    )]);
  }

  public function update(int $id): mixed
  {
    try {
      $em = EM::make();
      $user = $em->find(User::class, $id);
      $user->init(
        name: Request::input('name'),
        email: Request::input('email'),
        password: $user->getPassword()
      );
      $em->persist($user);
      $em->flush();
      return SimpleRouter::response()->json(['user' => $user->serialize()]);
    } catch (\Throwable $th) {
      return SimpleRouter::response()->json(['message' => $th->getMessage()]);
    }
  }

  public function destroy(int $id): mixed
  {
    try {
      $em = EM::make();
      $user = $em->find(User::class, $id);
      $em->remove($user);
      $em->flush();
      return SimpleRouter::response()->json(['message' => 'OK']);
    } catch (\Throwable $th) {
      return SimpleRouter::response()->json(['message' => $th->getMessage()]);
    }
  }
  public function lookup(int $id): mixed
  {
    return SimpleRouter::response()->json([
      'user' => EM::make()->find(User::class, $id)->serialize(true)
    ]);
  }
}
