<?php
namespace App\Doctrine\Models;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table('employee_tpcc')]
class EmployeeTPCC
{
    #[Id]
    #[Column()]
    #[GeneratedValue]
    private ?int $id = null;

    #[Column()]
    private string $name;

    #[Column()]
    private string $address;

    public function serialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address
        ];
    }

    public function init($name, $address): void
    {
        $this->name = $name;
        $this->address = $address;
    }
}
