<?php
namespace App\Doctrine\Models;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[InheritanceType('JOINED')]
#[DiscriminatorColumn(name: 'type', type: 'string')]
#[DiscriminatorMap(['permanent' => PermanentTPC::class, 'contract' => ContractTPC::class])]
#[Table('employee_tpc')]
class EmployeeTPC
{
    #[Id]
    #[Column()]
    #[GeneratedValue]
    protected int|null $id = null;

    #[Column()]
    protected string $name;

    #[Column()]
    protected string $address;

    public function serialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
        ];
    }
}
