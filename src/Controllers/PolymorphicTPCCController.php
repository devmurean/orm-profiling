<?php
namespace App\Controllers;

class PolymorphicTPCCController extends Controller
{
    const METRIC = 'polymorphic-tpcc';
    public function createOperation($orm)
    {
        return $this->selectORM($orm, self::METRIC)->createOperation();
    }
    public function updateOperation($orm)
    {
        return $this->selectORM($orm, self::METRIC)->updateOperation();
    }
    public function readOperation($orm)
    {
        return $this->selectORM($orm, self::METRIC)->readOperation();
    }
    public function deleteOperation($orm)
    {
        return $this->selectORM($orm, self::METRIC)->deleteOperation();
    }
    public function lookupOperation($orm)
    {
        return $this->selectORM($orm, self::METRIC)->lookupOperation();
    }
}
