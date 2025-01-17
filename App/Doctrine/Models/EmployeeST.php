<?php

namespace App\Doctrine\Models;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'employee_st')]
class EmployeeST
{
  #[Id]
  #[Column(name: 'id', type: 'integer')]
  #[GeneratedValue]
  protected int|null $id = null;

  #[Column(length: 50)]
  protected string $name;

  #[Column(type: 'text')]
  protected string $address;

  #[Column(name: 'nik', nullable: true, type: 'string')]
  protected ?string $nik = null;

  #[Column(nullable: true)]
  protected ?int $contract_duration = null;

  public function init($name, $address, $nik = null, $contract_duration = null): void
  {
    $this->name = $name;
    $this->address = $address;
    $this->nik = $nik ? $nik : $this->nik;
    $this->contract_duration = $contract_duration ? $contract_duration : $this->contract_duration;
  }

  public function serialize(): array
  {
    return [
      'id' => $this->id,
      'name' =>  $this->name,
      'address' => $this->address,
      'nik' => $this->nik,
      'contract_duration' => $this->contract_duration,
    ];
  }

  public function getContractDuration(): int|null
  {
    return $this->contract_duration;
  }

  public function isPermanent()
  {
    return $this->nik !== null;
  }
}
