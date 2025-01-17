<?php

namespace App\Doctrine;

use App\Doctrine\EM;
use App\Doctrine\Helpers\ModelCollection;
use App\Doctrine\Models\EmployeeTPC;
use App\Doctrine\Models\PermanentTPC;
use App\Interface\ORMDriver;
use App\Request;
use Pecee\SimpleRouter\SimpleRouter;

class PolymorphicQuery implements ORMDriver
{
  public function create(): mixed
  {
    try {
      $employee = new PermanentTPC;
      $employee->init(
        name: Request::input('name'),
        address: Request::input('address'),
        nik: Request::input('nik'),
      );
      $em = EM::make();
      $em->persist($employee);
      $em->flush();

      return SimpleRouter::response()->json(['employee' => $employee->serialize()]);
    } catch (\Throwable $th) {
      return SimpleRouter::response()->json(['message' => $th->getMessage()]);
    }
  }

  public function read(): mixed
  {
    return SimpleRouter::response()->json(['employees' => ModelCollection::serialize(
      EM::make()->getRepository(EmployeeTPC::class)->findAll()
    )]);
  }

  public function update(int $id): mixed
  {
    try {
      $em = EM::make();
      $employee = $em->find(EmployeeTPC::class, $id);
      $employee->init(
        name: Request::input('name'),
        address: Request::input('address'),
        nik: Request::input('nik'),
      );
      $em->persist($employee);
      $em->flush();
      return SimpleRouter::response()->json(['employee' => $employee->serialize()]);
    } catch (\Throwable $th) {
      return SimpleRouter::response()->json(['message' => $th->getMessage()]);
    }
  }
  public function destroy(int $id): mixed
  {
    try {
      $em = EM::make();
      $employee = $em->find(EmployeeTPC::class, $id);
      $em->remove($employee);
      $em->flush();
      return SimpleRouter::response()->json(['message' => 'OK']);
    } catch (\Throwable $th) {
      return SimpleRouter::response()->json(['message' => $th->getMessage()]);
    }
  }
  public function lookup(int $id): mixed
  {
    return SimpleRouter::response()->json([
      'employee' => EM::make()->find(EmployeeTPC::class, $id)->serialize()
    ]);
  }
}
