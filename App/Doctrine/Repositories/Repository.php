<?php

namespace App\Doctrine\Repositories;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManager;

class Repository
{
    protected EntityManager $em;

    public function __construct()
    {
        require_once realpath('.') . '/App/Bootstraps/DoctrineBootstrap.php';

        $this->em = getEntityManager();
    }

    public function __destruct()
    {
        if ((bool) $_ENV['LOG_MEMORY_USAGE'] === true) {
            $filename = $_SERVER['REQUEST_METHOD'] . str_replace('/', '.', $_SERVER['REQUEST_URI']);

            $peakMemoryUsage = memory_get_peak_usage();
            $filePath = realpath('.') . '/bin/memory-profiling-result/' . $filename . '.txt';
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
}
