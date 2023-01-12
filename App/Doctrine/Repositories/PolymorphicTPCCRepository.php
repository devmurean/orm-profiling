<?php
namespace App\Doctrine\Repositories;

use App\Doctrine\Models\ContractTPCC;
use App\Doctrine\Models\EmployeeTPCC;
use App\Doctrine\Models\PermanentTPCC;

class PolymorphicTPCCRepository extends Repository
{
    public function createOperation()
    {
        $name = $this->faker->name;
        $address = $this->faker->address;

        $employee = new EmployeeTPCC;
        $employee->init(name: $name, address: $address);
       
        $object = new PermanentTPCC;
        $object->init($name, $address, rand(10**5, 10**6-1));

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
        $entityClass = PermanentTPCC::class;
        $repository = $this->em->getRepository($entityClass)->findAll();
        return response()->json([
            'employees' => $this->serializeCollection($repository)
        ]);
    }
    public function updateOperation()
    {
        $entityClass = PermanentTPCC::class;
        $employee = $this->randomEntity($entityClass);
        $name = $this->faker->name;
        $address = $this->faker->address;
        $employee->init($name, $address, rand(10**5, 10**6-1));

        $this->em->persist($employee);
        $this->em->flush();
        return response()->json([
            'employee' => $employee->serialize()
        ]);
    }
    public function deleteOperation()
    {
        $entityClass = PermanentTPCC::class;
        $employee = $this->randomEntity($entityClass);
        $this->em->remove($employee);
        $this->em->flush();

        return response()->json([
            'employee' => $employee->serialize()
        ]);
    }
    public function lookupOperation()
    {
        $entityClass = PermanentTPCC::class;
       
        return response()->json([
            'employee' => $this->randomEntity($entityClass)->serialize()
        ]);
    }
}
