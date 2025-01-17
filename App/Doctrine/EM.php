<?php

namespace App\Doctrine;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Symfony\Component\Cache\Adapter\PhpFilesAdapter;

class EM
{
  public static function make(): EntityManager
  {
    $config = ORMSetup::createAttributeMetadataConfiguration(
      paths: array(realpath('.') . '/App/Doctrine/Models'),
      isDevMode: false
    );

    $cache = new PhpFilesAdapter('doctrine_metadata', 0, getcwd());
    $config->setMetadataCache($cache);

    // the connection configuration
    $connection = DriverManager::getConnection([
      'host'     => $_ENV['DB_HOST'],
      'driver'   => $_ENV['DB_DOCTRINE_DRIVER'],
      'user'     => $_ENV['DB_USER'],
      'password' => $_ENV['DB_PASSWORD'],
      'dbname'   => $_ENV['DB_NAME'],
    ], $config);


    return new EntityManager($connection, $config);
  }
}
