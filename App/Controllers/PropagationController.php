<?php
namespace App\Controllers;

class PropagationController extends Controller
{
    private const METRIC = 'propagation';
    public function invoke($orm, $action)
    {
        $object = $this->selectORM($orm, self::METRIC);
        switch ($action) {
            case 'add':
                return $object->addAttribute();
            case 'update':
                return $object->updateAttribute();
            case 'delete':
                $columnName = 'c_' . rand(10**3, 10**4-1);
                $command = 'mysql -u ' . $_ENV['DB_USER'] . ' -p' . $_ENV['DB_PASSWORD'] .
                    ' -D ' . $_ENV['DB_NAME'] .
                    ' -e "ALTER TABLE user_isolation_propagations ADD COLUMN ' . $columnName . ' INT NULL;"';
                exec($command);
                return $object->deleteAttribute($columnName);
        }
    }
}
