<?php
namespace App\Doctrine\Models;

use Doctrine\Common\Collections\Collection;

class Entity
{
    protected function serializeCollection(Collection $collection): array
    {
        $result = [];
        foreach ($collection as $item) {
            $result[] = $item->serialize();
        }
        return $result;
    }
}
