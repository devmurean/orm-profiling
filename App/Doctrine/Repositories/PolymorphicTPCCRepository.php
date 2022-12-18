<?php
namespace App\Doctrine\Repositories;

use App\Doctrine\Models\ContractTPCC;
use App\Doctrine\Models\EmployeeTPCC;
use App\Doctrine\Models\PermanentTPCC;

class PolymorphicTPCCRepository extends Repository
{
    public function createOperation()
    {
        $selection = $this->faker->randomElement(['permanent', 'contract']);
        $name = $this->faker->name;
        $address = $this->faker->address;

        $employee = new EmployeeTPCC;
        $employee->init(name: $name, address: $address);

        $object = null;
        if ($selection === 'permanent') {
            $object = new PermanentTPCC;
            $object->init($name, $address, rand(10**5, 10**6-1));
        } else {
            $object = new ContractTPCC;
            $object->init($name, $address, rand(1, 5));
        }

        $this->em->persist($employee);
        $this->em->persist($object);
        $this->em->flush();
        return response()->json([
            'employee' => $employee->serialize(),
            $selection => $object->serialize()
        ]);
    }
    public function readOperation()
    {
        $selection = $this->faker->randomElement(['permanent', 'contract']);
        $entityClass = ($selection === 'permanent') ? PermanentTPCC::class : ContractTPCC::class;
        $repository = $this->em->getRepository($entityClass)->findAll();
        return response()->json([
            'employees' => $this->serializeCollection($repository)
        ]);
    }
    public function updateOperation()
    {
        $selection = $this->faker->randomElement(['permanent', 'contract']);
        $entityClass = ($selection === 'permanent') ? PermanentTPCC::class : ContractTPCC::class;
        $employee = $this->randomEntity($entityClass, random_max: 2000);
        $name = $this->faker->name;
        $address = $this->faker->address;
        if ($selection === 'permanent') {
            $employee->init($name, $address, rand(10**5, 10**6-1));
        } else {
            $employee->init($name, $address, rand(1, 5));
        }
        $this->em->persist($employee);
        $this->em->flush();
        return response()->json([
            'employee' => $employee->serialize()
        ]);
    }
    public function deleteOperation()
    {
        $selection = $this->faker->randomElement(['permanent', 'contract']);
        $entityClass = ($selection === 'permanent') ? PermanentTPCC::class : ContractTPCC::class;
        $employee = $this->randomEntity($entityClass, random_max: 2000);
        $this->em->remove($employee);
        $this->em->flush();

        return response()->json([
            'employee' => $employee->serialize()
        ]);
    }
    public function lookupOperation()
    {
        $selection = $this->faker->randomElement(['permanent', 'contract']);
        $entityClass = ($selection === 'permanent') ? PermanentTPCC::class : ContractTPCC::class;
       
        return response()->json([
            'employee' => $this->randomEntity($entityClass, random_max: 2000)->serialize()
        ]);
    }
}
