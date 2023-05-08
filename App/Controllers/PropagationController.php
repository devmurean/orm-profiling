<?php

namespace App\Controllers;

class PropagationController extends Controller
{
    private const METRIC = 'propagation';
    private string $columnName;

    public function invoke($orm, $action)
    {
        $object = $this->selectORM($orm, self::METRIC);
        $this->columnName = 'c_' . rand(10 ** 3, 10 ** 4 - 1);
        switch ($action) {
            case 'add':
                $result = $object->addAttribute($this->columnName);
                $this->dropColumn();
                return $result;
            case 'update':
                return $object->updateAttribute($this->columnName);
            case 'delete':
                $this->addColumn();
                return $object->deleteAttribute($this->columnName);
        }
    }

    private function addColumn()
    {
        $command = 'mysql -u ' . $_ENV['DB_USER'] . ' -p' . $_ENV['DB_PASSWORD'] .
            ' -D ' . $_ENV['DB_NAME'] .
            ' -e "ALTER TABLE user_isolation_propagations ADD COLUMN ' . $this->columnName . ' INT NULL;"';
        exec($command);
    }

    private function dropColumn()
    {
        $command = 'mysql -u ' . $_ENV['DB_USER'] . ' -p' . $_ENV['DB_PASSWORD'] .
            ' -D ' . $_ENV['DB_NAME'] .
            ' -e "ALTER TABLE user_isolation_propagations DROP COLUMN ' . $this->columnName . ';"';
        exec($command);
    }
}
