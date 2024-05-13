<?php

namespace App\Doctrine;

use App\Doctrine\EM;
use App\Doctrine\Helpers\ModelCollection;
use App\Doctrine\Models\EmployeeST;
use App\Interface\ORMDriver;
use App\Request;
use Pecee\SimpleRouter\SimpleRouter;

class ST implements ORMDriver
{
  public function create(): mixed
  {
    try {
      $employee = new EmployeeST;
      $employee->init(
        name: Request::input('name'),
        address: Request::input('address'),
        nik: Request::input('nik'),
        contract_duration: Request::input('contract_duration'),
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
      EM::make()->getRepository(EmployeeST::class)->findAll()
    )]);
  }

  public function update(int $id): mixed
  {
    try {
      $em = EM::make();
      $employee = $em->find(EmployeeST::class, $id);
      $employee->init(
        name: Request::input('name'),
        address: Request::input('address'),
        nik: $employee->nik,
        contract_duration: $employee->contract_duration,
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
      $employee = $em->find(EmployeeST::class, $id);
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
      'employee' => EM::make()->find(EmployeeST::class, $id)->serialize()
    ]);
  }
}
