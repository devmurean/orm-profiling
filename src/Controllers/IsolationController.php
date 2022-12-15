<?php
namespace App\Controllers;

class IsolationController extends Controller
{
    private const METRIC = 'isolation';
    public function invoke($orm, $action)
    {
        $object = $this->selectORM($orm, self::METRIC);
        switch ($action) {
            case 'create':
                return $object->createDatabase();
            case 'update':
                return $object->alterDatabaseEncryption(array_rand([true, false], 1));
            case 'delete':
                return $object->deleteDatabase();
        }
    }
}
