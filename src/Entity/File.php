<?php

namespace App\Entity;

use App\Repository\FileRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity(repositoryClass: FileRepository::class)]
#[ORM\InheritanceType('SINGLE_TABLE')]
#[ORM\DiscriminatorColumn(name: 'type', type: 'string')]
#[ORM\DiscriminatorMap(['video' => 'Video', 'pdf' => 'Pdf'])]
abstract class File
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[\Symfony\Component\Validator\Constraints\File(
        maxSize: '1024k',
        mimeTypes: ['video/mp4', 'applications/pdf', 'application/x-pdf'],
        mimeTypesMessage: 'Please upload valid file'
    )]
    private ?string $filename = null;

    #[ORM\Column]
    private ?int $size = null;

    #[ORM\Column(length: 255)]
    #[NotBlank]
    #[Length(
        min: 2,
        max: 20,
        minMessage: 'Video title must be at least {{ limit }} characters long',
        maxMessage: 'Video title cannot be longer than {{ limit }} characters'
    )]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'files')]
    private ?Author $author = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): self
    {
        $this->author = $author;

        return $this;
    }
}
