<?php

namespace App\Doctrine\Actions;

use App\Doctrine\EM;
use App\Doctrine\Helpers\ModelCollection;
use App\Doctrine\Models\EmployeeTPC;
use App\Doctrine\Models\PermanentTPC;
use App\Interface\ORMDriver;

class TPC implements ORMDriver
{
  public function create(array $data): mixed
  {
    try {
      $employee = new PermanentTPC;
      $employee->init(
        name: $data['name'],
        address: $data['address'],
        nik: $data['nik'],
      );
      $em = EM::make();
      $em->persist($employee);
      $em->flush();

      return json_encode(['employee' => $employee->serialize()]);
    } catch (\Throwable $th) {
      return json_encode(['message' => $th->getMessage()]);
    }
  }

  public function read(): mixed
  {
    return json_encode(['employees' => ModelCollection::serialize(
      EM::make()->getRepository(EmployeeTPC::class)->findAll()
    )]);
  }

  public function update(int $id, array $data): mixed
  {
    try {
      $em = EM::make();
      $employee = $em->find(EmployeeTPC::class, $id);
      $employee->init(
        name: $data['name'],
        address: $data['address'],
        nik: $employee->nik,
      );
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
      $employee = $em->find(EmployeeTPC::class, $id);
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
      'employee' => EM::make()->find(EmployeeTPC::class, $id)->serialize()
    ]);
  }
}
