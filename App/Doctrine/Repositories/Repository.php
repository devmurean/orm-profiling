<?php
namespace App\Doctrine\Repositories;

use Doctrine\Common\Collections\Collection;
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

    protected function serializeCollection(Collection|array $collection): array
    {
        $result = [];
        foreach ($collection as $item) {
            $result[] = $item->serialize();
        }
        return $result;
    }

    protected function randomEntity(string $class): object
    {
        return $this->em->find($class, rand(1, 10000));
    }
}
