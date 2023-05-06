<?php

namespace App\Doctrine\Repositories;

use App\Doctrine\Models\EmployeeST;

class PolymorphicSTRepository extends Repository
{
    public function createOperation($data)
    {
        $employee = new EmployeeST;

        $employee->init(
            name: $data['name'],
            address: $data['address'],
            nik: $data['nik'],
            contract_duration: $data['contract_duration'],
        );
        $this->em->persist($employee);
        $this->em->flush();

        return response()->json(['employee' => $employee->serialize()]);
    }
    public function readOperation()
    {
        $employees = $this->em->getRepository(EmployeeST::class)->findAll();
        return response()->json([
            'employees' => $this->serializeCollection($employees)
        ]);
    }
    public function updateOperation($data, $id)
    {
        try {
            $employee = $this->em->find(EmployeeST::class, $id);
            $employee->init(
                name: $data['name'],
                address: $data['address'],
                nik: $employee->nik,
                contract_duration: $employee->contract_duration,
            );
            $this->em->persist($employee);
            $this->em->flush();

            return response()->json(['employee' => $employee->serialize()]);
        } catch (\Throwable $th) {
            return response()->json(['employee' => $th->getMessage()]);
        }
    }
    public function deleteOperation($id)
    {
        $employee = $this->em->find(EmployeeST::class, $id);
        $this->em->remove($employee);
        $this->em->flush();

        return response()->json(['employee' => $employee->serialize()]);
    }
    public function lookupOperation($id)
    {
        $employee = $this->em->find(EmployeeST::class, $id);
        return response()->json(['employee' => $employee->serialize()]);
    }
}
