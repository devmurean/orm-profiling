<?php
namespace App\Doctrine\Repositories;

use App\Doctrine\Models\EmployeeST;

class PolymorphicSTRepository extends Repository
{
    public function createOperation()
    {
        $employee = new EmployeeST;
        $type = $this->faker->randomElement(['permanent', 'contract']);
        $employee->init(
            name:  $this->faker->name,
            address: $this->faker->address,
            nik: $type === 'permanent' ? rand(10**5, 10**6-1) : null,
            contract_duration: $type === 'contract' ? rand(1, 5) :null,
        );
        $this->em->persist($employee);
        $this->em->flush();

        return response()->json([
            'employee' => $employee->serialize()
        ]);
    }
    public function readOperation()
    {
        $employees = $this->em->getRepository(EmployeeST::class)->findAll();
        return response()->json([
            'employees' => $this->serializeCollection($employees)
        ]);
    }
    public function updateOperation()
    {
        $employee = $this->randomEntity(EmployeeST::class);
        $employee->init(
            name:  $this->faker->name,
            address: $this->faker->address,
            nik: $employee->isPermanent() ? rand(10**5, 10**6-1) : null,
            contract_duration: !$employee->isPermanent() ? rand(1, 5) : null,
        );
        $this->em->persist($employee);
        $this->em->flush();

        return response()->json([
            'employee' => $employee->serialize()
        ]);
    }
    public function deleteOperation()
    {
        $employee = $this->randomEntity(EmployeeST::class);
        $this->em->remove($employee);
        $this->em->flush();

        return response()->json([
            'employee' => $employee->serialize()
        ]);
    }
    public function lookupOperation()
    {
        return response()->json([
            'employee' => $this->randomEntity(EmployeeST::class)->serialize()
        ]);
    }
}
