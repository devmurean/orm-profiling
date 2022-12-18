<?php

namespace App\Controllers;

use App\Doctrine\Repositories\CRUDRepository as DoctrineCRUDRepository;
use App\Doctrine\Repositories\PolymorphicSTRepository as DoctrineSTRepository;
use App\Doctrine\Repositories\PolymorphicTPCRepository as DoctrineTPCRepository;
use App\Doctrine\Repositories\PolymorphicTPCCRepository as DoctrineTPCCRepository;
use App\Doctrine\Repositories\PropagationRepository as DoctrinePropagationRepository;
use App\Doctrine\Repositories\IsolationRepository as DoctrineIsolationRepository;

use App\Eloquent\Repositories\CRUDRepository as EloquentCRUDRepository;
use App\Eloquent\Repositories\PolymorphicSTRepository as EloquentSTRepository;
use App\Eloquent\Repositories\PolymorphicTPCRepository as EloquentTPCRepository;
use App\Eloquent\Repositories\PolymorphicTPCCRepository as EloquentTPCCRepository;
use App\Eloquent\Repositories\PropagationRepository as EloquentPropagationRepository;
use App\Eloquent\Repositories\IsolationRepository as EloquentIsolationRepository;

class Controller
{
    protected function selectORM(string $orm, string $metric = 'crud')
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

            case 'propagation':
                return $orm === 'doctrine'
                    ? new DoctrinePropagationRepository
                    : new EloquentPropagationRepository;
            case 'isolation':
                return $orm === 'doctrine'
                    ? new DoctrineIsolationRepository
                    : new EloquentIsolationRepository;
        }
    }
}
