<?php
namespace App\Doctrine\Models;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table('doctrine_contract_tpc')]
class ContractTPC extends EmployeeTPC
{
    #[Column()]
    private string $contract_duration;

    public function serialize(): array
    {
        return array_merge(parent::serialize(), [
            'contract_duration' => $this->contract_duration
        ]);
    }

    public function init($name, $address, $contract_duration): void
    {
        $this->name = $name;
        $this->address = $address;
        $this->contract_duration = $contract_duration;
    }
}
