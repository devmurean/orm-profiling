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
    private ?int $id = null;

    #[Column()]
    private string $name;

    #[Column()]
    private string $address;

    #[Column()]
    private string $nik;

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
