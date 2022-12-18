<?php
namespace App\Doctrine\Models;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'tasks')]
class Task
{
    #[Id]
    #[Column(name:'id', type: 'integer')]
    #[GeneratedValue]
    private $id;

    #[Column(name: 'description', type: 'text')]
    private $description;

    #[ManyToOne(targetEntity: User::class, inversedBy: 'tasks')]
    #[JoinColumn(name: 'user_id', referencedColumnName:'id')]
    private $user;

    public function serialize()
    {
        return [
            'id' => $this->id,
            'description' => $this->description
        ];
    }
}
