<?php
namespace App\Doctrine\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
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
    #[Column(name:'id', type: 'integer')]
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

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}