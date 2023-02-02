<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

#[ORM\Entity(repositoryClass: VideoRepository::class)]
class Video extends File
{
    #[ORM\Column(length: 255)]
    #[NotBlank]
//    #[Email(message: 'The email {{ value }} is not a valid email.')]
    private ?string $format = null;

    #[ORM\Column]
    private ?int $duration = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[NotBlank]
    #[Type(\DateTime::class)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'videos')]
    private ?SecurityUser $securityUser = null;

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getSecurityUser(): ?SecurityUser
    {
        return $this->securityUser;
    }

    public function setSecurityUser(?SecurityUser $securityUser): self
    {
        $this->securityUser = $securityUser;

        return $this;
    }
}
