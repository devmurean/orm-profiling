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
                $dbName = 'test_db_' . rand(10**4, 10**5-1);
                $result = $object->createDatabase($dbName);
                // drop the database so database is not polluted
                $command = 'mysql -u ' . $_ENV['DB_USER'] . ' -p' . $_ENV['DB_PASSWORD'] .
                    ' -e "DROP DATABASE ' . $dbName . ';"';
                exec($command);
                return $result;
            case 'update':
                // test database should be created before test
                $encrypted = [true, false];
                return $object->alterDatabaseEncryption($encrypted[array_rand($encrypted, 1)]);
            case 'delete':
                $dbName = 'test_db_' . rand(10**4, 10**5-1);
                $command = 'mysql -u ' . $_ENV['DB_USER'] . ' -p' . $_ENV['DB_PASSWORD'] .
                    ' -e "CREATE DATABASE ' . $dbName . ';"';
                exec($command);
                return $object->deleteDatabase($dbName);
        }
    }
}
