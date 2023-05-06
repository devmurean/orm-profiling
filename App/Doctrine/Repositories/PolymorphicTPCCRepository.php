<?php

namespace App\Doctrine\Repositories;

use App\Doctrine\Models\ContractTPCC;
use App\Doctrine\Models\EmployeeTPCC;
use App\Doctrine\Models\PermanentTPCC;

class PolymorphicTPCCRepository extends Repository
{
    public function createOperation($data)
    {
        $name = $data['name'];
        $address = $data['address'];

        $employee = new EmployeeTPCC;
        $employee->init(name: $name, address: $address);

        $object = new PermanentTPCC;
        $object->init($name, $address, $data['nik']);

        $this->em->persist($employee);
        $this->em->persist($object);
        $this->em->flush();
        return response()->json([
            'employee' => $employee->serialize(),
            'permanent' => $object->serialize()
        ]);
    }
    public function readOperation()
    {
        $entityClass = EmployeeTPCC::class;
        $repository = $this->em->getRepository($entityClass)->findAll();
        return response()->json([
            'employees' => $this->serializeCollection($repository)
        ]);
    }
    public function updateOperation($data, $id)
    {
        $entityClass = EmployeeTPCC::class;
        $employee = $this->em->find($entityClass, $id);
        $name = $data['name'];
        $address = $data['address'];
        $employee->init($name, $address);

        $this->em->persist($employee);
        $this->em->flush();
        return response()->json([
            'employee' => $employee->serialize()
        ]);
    }
    public function deleteOperation($id)
    {
        $entityClass = EmployeeTPCC::class;
        $employee = $this->em->find($entityClass, $id);
        $this->em->remove($employee);
        $this->em->flush();

        return response()->json([
            'employee' => $employee->serialize()
        ]);
    }
    public function lookupOperation($id)
    {
        $entityClass = EmployeeTPCC::class;

        return response()->json([
            'employee' => $this->em->find($entityClass, $id)->serialize()
        ]);
    }
}
