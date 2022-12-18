<?php
namespace App\Doctrine\Models;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table('contract_tpcc')]
class ContractTPCC
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
    private int $contract_duration;

    public function serialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'contract_duration' => $this->contract_duration
        ];
    }

    public function init($name, $address, $duration): void
    {
        $this->name = $name;
        $this->address = $address;
        $this->contract_duration = $duration;
    }
}
