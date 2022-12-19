<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

function getEntityManager(): EntityManager
{
    $paths = array(realpath('.') . '/App/Doctrine/Models');
    $isDevMode = false;

    // the connection configuration
    $dbParams = array(
        'host'     => $_ENV['DB_HOST'],
        'driver'   => $_ENV['DB_DOCTRINE_DRIVER'],
        'user'     => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
        'dbname'   => $_ENV['DB_NAME'],
    );

    $config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
    return EntityManager::create($dbParams, $config);
}
