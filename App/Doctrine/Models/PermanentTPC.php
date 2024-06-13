<?php

namespace App\Doctrine\Models;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table('permanent_tpc')]
class PermanentTPC extends EmployeeTPC
{
  #[Column()]
  protected string $nik;

  public function serialize(): array
  {
    return array_merge(parent::serialize(), [
      'nik' => $this->nik
    ]);
  }

  public function init($name, $address, $nik): void
  {
    $this->name = $name;
    $this->address = $address;
    $this->nik = $nik;
  }
}
