<?php

namespace App\Controllers;

class PolymorphicTPCCController extends Controller
{
    const METRIC = 'polymorphic-tpcc';
    public function createOperation($orm)
    {
        $data = request()->body();
        return $this->selectORM($orm, self::METRIC)->createOperation($data);
    }
    public function updateOperation($orm, $id)
    {
        $data = request()->body();
        return $this->selectORM($orm, self::METRIC)->updateOperation($data, $id);
    }
    public function readOperation($orm)
    {
        return $this->selectORM($orm, self::METRIC)->readOperation();
    }
    public function deleteOperation($orm, $id)
    {
        return $this->selectORM($orm, self::METRIC)->deleteOperation($id);
    }
    public function lookupOperation($orm, $id)
    {
        return $this->selectORM($orm, self::METRIC)->lookupOperation($id);
    }
}
