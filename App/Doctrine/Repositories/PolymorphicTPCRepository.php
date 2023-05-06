<?php

namespace App\Doctrine\Repositories;

use App\Doctrine\Models\ContractTPC;
use App\Doctrine\Models\EmployeeTPC;
use App\Doctrine\Models\PermanentTPC;

class PolymorphicTPCRepository extends Repository
{
    public function createOperation($data)
    {
        $employee = new PermanentTPC;
        $employee->init(
            name: $data['name'],
            address: $data['address'],
            nik: $data['nik'],
        );

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
    public function updateOperation($data, $id)
    {
        $employee = $this->em->find(EmployeeTPC::class, $id);
        // if (get_class($employee) === PermanentTPC::class) {
        $employee->init(
            name: $data['name'],
            address: $data['address'],
            nik: $employee->nik,
        );
        // } else {
        //     $employee->init(
        //         name: $this->faker->name,
        //         address: $this->faker->address,
        //         contract_duration: rand(1, 5),
        //     );
        // }
        $this->em->persist($employee);
        $this->em->flush();
        return response()->json([
            'employee' => $employee->serialize()
        ]);
    }
    public function deleteOperation($id)
    {
        $employee = $this->em->find(EmployeeTPC::class, $id);
        $this->em->remove($employee);
        $this->em->flush();
        return response()->json(['employee' => $employee->serialize()]);
    }
    public function lookupOperation($id)
    {
        $employee = $this->em->find(EmployeeTPC::class, $id);
        return response()->json(['employee' => $employee->serialize()]);
    }
}
