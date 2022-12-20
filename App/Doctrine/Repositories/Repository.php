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

    public function __destruct()
    {
        if ((bool) $_ENV['LOG_MEMORY_USAGE'] === true) {
            $filename = $_SERVER['REQUEST_METHOD'] . str_replace('/', '.', $_SERVER['PATH_INFO']);
        
            $peakMemoryUsage = memory_get_peak_usage();
            echo $filePath = realpath('.') . '/bin/memory-profiling-result/'.$filename.'.txt';
            if (!file_exists($filePath)) {
                touch($filePath);
            }
            $content = file_get_contents($filePath);
            $content .= time() . '.' . $filename . ':' . $peakMemoryUsage . PHP_EOL;
            file_put_contents($filePath, $content);
        }
    }

    protected function serializeCollection(Collection|array $collection): array
    {
        $result = [];
        foreach ($collection as $item) {
            $result[] = $item->serialize();
        }
        return $result;
    }

    protected function randomEntity(string $class, int $random_min = 1, int $random_max = 10000): object
    {
        return $this->em->find($class, rand($random_min, $random_max));
    }
}
