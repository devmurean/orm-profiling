<?php

namespace App\Controllers;

use App\Eloquent\Repositories\CRUDRepository as EloquentCRUDRepository;
use App\Doctrine\Repositories\CRUDRepository as DoctrineCRUDRepository;
use App\Eloquent\Repositories\PolymorphicSTRepository as EloquentSTRepository;
use App\Doctrine\Repositories\PolymorphicSTRepository as DoctrineSTRepository;
use App\Eloquent\Repositories\PolymorphicTPCRepository as EloquentTPCRepository;
use App\Doctrine\Repositories\PolymorphicTPCRepository as DoctrineTPCRepository;
use App\Eloquent\Repositories\PolymorphicTPCCRepository as EloquentTPCCRepository;
use App\Doctrine\Repositories\PolymorphicTPCCRepository as DoctrineTPCCRepository;

class Controller
{
    protected function selectORM(string $orm, string $metric = 'crud'): DoctrineCRUDRepository|EloquentCRUDRepository
    {
        switch ($metric) {
            case 'crud':
                return $orm === 'doctrine'
                    ? new DoctrineCRUDRepository
                    : new EloquentCRUDRepository;
            case 'polymorphic-st':
                return $orm === 'doctrine'
                    ? new DoctrineSTRepository
                    : new EloquentSTRepository;
            case 'polymorphic-tpc':
                return $orm === 'doctrine'
                    ? new DoctrineTPCRepository
                    : new EloquentTPCRepository;
            case 'polymorphic-tpcc':
                return $orm === 'doctrine'
                    ? new DoctrineTPCCRepository
                    : new EloquentTPCCRepository;
        }
    }
}
