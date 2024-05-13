<?php

namespace App\Doctrine;

use App\Doctrine\EM;
use App\Doctrine\Helpers\ModelCollection;
use App\Doctrine\Models\EmployeeTPCC;
use App\Doctrine\Models\PermanentTPCC;
use App\Interface\ORMDriver;
use App\Request;
use Pecee\SimpleRouter\SimpleRouter;

class TPCC implements ORMDriver
{
  public function create(): mixed
  {
    try {
      $name = Request::input('name');
      $address = Request::input('address');

      $employee = new EmployeeTPCC;
      $employee->init(name: $name, address: $address);

      $object = new PermanentTPCC;
      $object->init($name, $address, Request::input('nik'));

      $em = EM::make();
      $em->persist($employee);
      $em->persist($object);
      $em->flush();
      return SimpleRouter::response()->json([
        'employee' => $employee->serialize(),
        'permanent' => $object->serialize()
      ]);
    } catch (\Throwable $th) {
      return SimpleRouter::response()->json(['message' => $th->getMessage()]);
    }
  }
  public function read(): mixed
  {
    return SimpleRouter::response()->json(['employees' => ModelCollection::serialize(
      EM::make()->getRepository(EmployeeTPCC::class)->findAll()
    )]);
  }

  public function update(int $id): mixed
  {
    try {
      $em = EM::make();
      $employee = $em->find(EmployeeTPCC::class, $id);
      $name = Request::input('name');
      $address = Request::input('address');
      $employee->init($name, $address);

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
      $employee = $em->find(EmployeeTPCC::class, $id);
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
      'employee' => EM::make()->find(EmployeeTPCC::class, $id)->serialize()
    ]);
  }
}
