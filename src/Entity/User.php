<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\HasLifecycleCallbacks]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user_table`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    #[ORM\PrePersist]
    public function setCreatedAtValues()
    {
        $createAt = new \DateTime();
        dd($createAt);
    }
}
