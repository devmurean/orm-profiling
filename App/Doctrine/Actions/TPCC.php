<?php

namespace App\Doctrine\Actions;

use App\Doctrine\EM;
use App\Doctrine\Helpers\ModelCollection;
use App\Doctrine\Models\EmployeeTPCC;
use App\Doctrine\Models\PermanentTPCC;
use App\Interface\ORMDriver;

class TPCC implements ORMDriver
{
  public function create(array $data): mixed
  {
    try {
      $name = $data['name'];
      $address = $data['address'];

      $employee = new EmployeeTPCC;
      $employee->init(name: $name, address: $address);

      $object = new PermanentTPCC;
      $object->init($name, $address, $data['nik']);

      $em = EM::make();
      $em->persist($employee);
      $em->persist($object);
      $em->flush();
      return json_encode([
        'employee' => $employee->serialize(),
        'permanent' => $object->serialize()
      ]);
    } catch (\Throwable $th) {
      return json_encode(['message' => $th->getMessage()]);
    }
  }
  public function read(): mixed
  {
    return json_encode(['employees' => ModelCollection::serialize(
      EM::make()->getRepository(EmployeeTPCC::class)->findAll()
    )]);
  }
  public function update(int $id, array $data): mixed
  {
    try {
      $em = EM::make();
      $employee = $em->find(EmployeeTPCC::class, $id);
      $name = $data['name'];
      $address = $data['address'];
      $employee->init($name, $address);

      $em->persist($employee);
      $em->flush();
      return json_encode(['employee' => $employee->serialize()]);
    } catch (\Throwable $th) {
      return json_encode(['message' => $th->getMessage()]);
    }
  }
  public function delete(int $id): mixed
  {
    try {
      $em = EM::make();
      $employee = $em->find(EmployeeTPCC::class, $id);
      $em->remove($employee);
      $em->flush();
      return json_encode(['message' => 'OK']);
    } catch (\Throwable $th) {
      return json_encode(['message' => $th->getMessage()]);
    }
  }
  public function lookup(int $id): mixed
  {
    return json_encode([
      'employee' => EM::make()->find(EmployeeTPCC::class, $id)->serialize()
    ]);
  }
}
