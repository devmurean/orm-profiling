<?php
namespace App\Doctrine\Repositories;

use App\Doctrine\Models\ContractTPC;
use App\Doctrine\Models\EmployeeTPC;
use App\Doctrine\Models\PermanentTPC;

class PolymorphicTPCRepository extends Repository
{
    public function createOperation()
    {
        $selection = $this->faker->randomElement(['permanent', 'contract']);
        $employee = null;
        if ($selection === 'permanent') {
            $employee = new PermanentTPC;
            $employee->init(
                name: $this->faker->name,
                address: $this->faker->address,
                nik: rand(10**5, 10**6-1),
            );
        } else {
            $employee = new ContractTPC;
            $employee->init(
                name: $this->faker->name,
                address: $this->faker->address,
                contract_duration: rand(1, 5),
            );
        }
        $this->em->persist($employee);
        $this->em->flush();

        return response()->json([
            'employee' => $employee->serialize()
        ]);
    }
    public function readOperation()
    {
        $employees = $this->em->getRepository(EmployeeTPC::class)->findAll();
        return response()->json([
            'employees' => $this->serializeCollection($employees)
        ]);
    }
    public function updateOperation()
    {
        $employee = $this->randomEntity(EmployeeTPC::class);
        if (get_class($employee) === PermanentTPC::class) {
            $employee->init(
                name: $this->faker->name,
                address: $this->faker->address,
                nik: rand(10**5, 10**6-1),
            );
        } else {
            $employee->init(
                name: $this->faker->name,
                address: $this->faker->address,
                contract_duration: rand(1, 5),
            );
        }
        $this->em->persist($employee);
        $this->em->flush();
        return response()->json([
            'employee' => $employee->serialize()
        ]);
    }
    public function deleteOperation()
    {
        $employee = $this->randomEntity(EmployeeTPC::class);
        $this->em->remove($employee);
        $this->em->flush();
        return response()->json([
            'employee' => $employee->serialize()
        ]);
    }
    public function lookupOperation()
    {
        $employee = $this->randomEntity(EmployeeTPC::class);
        return response()->json([
            'employee' => $employee->serialize()
        ]);
    }
}
