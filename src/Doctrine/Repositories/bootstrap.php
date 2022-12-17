<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

$paths = array(__DIR__. '/src');
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
$entityManager = EntityManager::create($dbParams, $config);
