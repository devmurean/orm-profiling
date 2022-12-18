<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

function getEntityManager(): EntityManager
{
    $paths = array(realpath('.'). '/App/Doctrine/Models');
    $isDevMode = false;
    
    // the connection configuration
    $dbParams = array(
        'host'     => 'localhost',
        'driver'   => 'pdo_mysql',
        'user'     => 'developer',
        'password' => 'developer',
        'dbname'   => 'orm_profiling',
    );
    
    $config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
    return EntityManager::create($dbParams, $config);
}
