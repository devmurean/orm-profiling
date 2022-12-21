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
                $dbName = $this->getRandomDbName();
                $result = $object->createDatabase($dbName);
                // drop the database so database is not polluted
                $this->manageDB(create: false, dbName: $dbName);
                return $result;
            case 'update':
                // test database should be created before test
                $encrypted = [true, false];
                $result = $object->alterDatabaseEncryption($encrypted[array_rand($encrypted, 1)]);
                return $result;
            case 'delete':
                $dbName = $this->getRandomDbName();
                $this->manageDB(create: true, dbName: $dbName);
                return $object->deleteDatabase($dbName);
        }
    }

    private function getRandomDbName(): string
    {
        return 'test_db_' . rand(10**4, 10**5-1);
    }

    private function manageDB(bool $create, string $dbName): void
    {
        $action = $create ? 'CREATE' : 'DROP';
        $command = 'mysql -u ' . $_ENV['DB_USER'] . ' -p' . $_ENV['DB_PASSWORD'] .
                    ' -e "' . $action . ' DATABASE ' . $dbName . ';"';
        exec($command);
    }
}
