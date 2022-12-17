<?php
namespace App\Doctrine\Repositories;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Faker\Factory;
use Faker\Generator;

class Repository
{
    protected Generator $faker;
    protected EntityManager $em;
    public function __construct()
    {
        $paths = array('/src/Doctrine/Models');
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
        $this->em = EntityManager::create($dbParams, $config);
        $this->faker = Factory::create();
    }
}
