<?php
namespace App\Doctrine\Models;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'desks')]
class Desk
{
    #[Id]
    #[Column(name:'id', type: 'integer')]
    #[GeneratedValue]
    private $id;

    #[Column(name: 'location', type: 'string', length: 30)]
    private $location;

    #[OneToOne(targetEntity: User::class, inversedBy: 'desk')]
    #[JoinColumn(name: 'user_id', referencedColumnName:'id')]
    private User|null $user = null;
}
