<?php
namespace App\Controllers;

class IsolationController extends Controller
{
    private const METRIC = 'isolation';
    public function invoke($orm, $action)
    {
        $object = $this->selectORM($orm, self::METRIC);
        switch ($action) {
            case 'add':
                return $object->createDatabase();
            case 'update':
                $encrypted = [true, false];
                return $object->alterDatabaseEncryption($encrypted[array_rand($encrypted, 1)]);
            case 'delete':
                return $object->deleteDatabase();
        }
    }
}
