<?php

namespace App\Doctrine\Models;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table('permanent_tpcc')]
class PermanentTPCC
{
  #[Id]
  #[Column()]
  #[GeneratedValue]
  protected ?int $id = null;

  #[Column()]
  protected string $name;

  #[Column()]
  protected string $address;

  #[Column()]
  protected string $nik;

  public function serialize(): array
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'address' => $this->address,
      'nik' => $this->nik
    ];
  }

  public function init($name, $address, $nik): void
  {
    $this->name = $name;
    $this->address = $address;
    $this->nik = $nik;
  }
}
