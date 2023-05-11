<?php

namespace App\Doctrine\Repositories;

use App\Instrumentation;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManager;

class Repository
{
    protected EntityManager $em;
    protected int $startMemory;

    public function __construct()
    {
        require_once realpath('.') . '/App/Bootstraps/DoctrineBootstrap.php';

        $this->em = getEntityManager();
        $this->startMemory = Instrumentation::MemoryLog(start: true);
    }

    public function __destruct()
    {
        Instrumentation::MemoryLog(start: false, startMemory: $this->startMemory);
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
