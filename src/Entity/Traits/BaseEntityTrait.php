<?php

namespace App\Entity\Traits;

use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait BaseEntityTrait
{
    public function __construct()
    {
        $this->setCreatedAt(new DateTimeImmutable());
    }

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Automatically sets the updatedAt value to the current DateTimeImmutable.
     * This method is called before the entity is updated to the database.
     */
    #[ORM\PreUpdate]
    public function setUpdatedAtValue(): static
    {
        $this->setUpdatedAt(new DateTimeImmutable());
        return $this;
    }
    #[ORM\PrePersist]
    public function setCreatedAtValue(): static
    {
        $this->setCreatedAt(new DateTimeImmutable());
        return $this;
    }
    public function __toString(): string
    {
        return $this->getName() ?? "unnamed Entity";
    }
}