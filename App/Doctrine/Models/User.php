<?php

namespace App\Doctrine\Models;

use App\Doctrine\Helpers\ModelCollection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'users')]
class User
{
  #[Id]
  #[Column(name: 'id', type: 'integer')]
  #[GeneratedValue]
  private $id;

  #[Column(name: 'name', type: 'string', length: 255)]
  private $name;

  #[Column(name: 'email', type: 'string', length: 255)]
  private $email;

  #[Column(name: 'password', type: 'string', length: 255)]
  private $password;

  #[OneToOne(targetEntity: Desk::class, mappedBy: 'user')]
  private Desk|null $desk = null;

  #[OneToMany(targetEntity: Task::class, mappedBy: 'user')]
  private Collection $tasks;

  #[ManyToMany(targetEntity: Role::class, inversedBy: 'users')]
  #[JoinTable(name: 'user_role')]
  private Collection $roles;

  public function __construct()
  {
    $this->tasks = new ArrayCollection();
    $this->roles = new ArrayCollection();
  }

  public function serialize(bool $withRelationship = false): array
  {
    $base = [
      'id' => $this->id,
      'name' => $this->name,
      'email' => $this->email,
    ];

    $relationships = $withRelationship ? [
      'tasks' => ModelCollection::serialize($this->tasks),
      'roles' => ModelCollection::serialize($this->roles),
      'desk' => $this->desk->serialize(),
    ] : [];
    return array_merge($base, $relationships);
  }

  public function getPassword(): string
  {
    return $this->password;
  }

  public function init(string $name, string $email, string $password): void
  {
    $this->name = $name;
    $this->email = $email;
    $this->password = $password;
  }
}
