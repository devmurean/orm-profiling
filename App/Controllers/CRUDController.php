<?php

namespace App\Controllers;

class CRUDController extends Controller
{
    public function createOperation($orm)
    {
        $data = request()->body();

        return $this->selectORM($orm)->createOperation($data);
    }

    public function updateOperation($orm, $id)
    {
        $data = request()->body();
        return $this->selectORM($orm)->updateOperation($data, $id);
    }

    public function deleteOperation($orm, $id)
    {
        return $this->selectORM($orm)->deleteOperation($id);
    }

    public function readOperation($orm)
    {
        return $this->selectORM($orm)->readOperation();
    }

    public function lookupOperation($orm, $id)
    {
        return $this->selectORM($orm)->lookupOperation($id);
    }
}
