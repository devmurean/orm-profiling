<?php

namespace App\Doctrine\Helpers;

use Doctrine\Common\Collections\Collection;

class ModelCollection
{
  public static function serialize(Collection|array $collection): array
  {
    $result = [];
    foreach ($collection as $item) {
      $result[] = $item->serialize();
    }
    return $result;
  }
}
