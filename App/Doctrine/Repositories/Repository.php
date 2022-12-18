<?php
namespace App\Doctrine\Repositories;

use Doctrine\ORM\EntityManager;
use Faker\Factory;
use Faker\Generator;

class Repository
{
    protected Generator $faker;
    protected EntityManager $em;
    public function __construct()
    {
        require_once realpath('.').'/App/Bootstraps/DoctrineBootstrap.php';

        $this->em = getEntityManager();
        $this->faker = Factory::create();
    }
}
