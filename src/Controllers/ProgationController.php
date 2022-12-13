<?php
namespace App\Controllers;

class ProgationController extends Controller
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
                return $object->deleteAttribute();
        }
    }
}
