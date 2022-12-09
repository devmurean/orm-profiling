<?php

namespace App\Controllers;

class CRUDController extends Controller
{
    public function createOperation($orm)
    {
        return $this->selectORM($orm)->createOperation();
    }

    public function updateOperation($orm)
    {
        return $this->selectORM($orm)->updateOperation();
    }

    public function deleteOperation($orm)
    {
        return $this->selectORM($orm)->deleteOperation();
    }

    public function readOperation($orm)
    {
        return $this->selectORM($orm)->readOperation();
    }

    public function lookupOperation($orm)
    {
        return $this->selectORM($orm)->lookupOperation();
    }
}
