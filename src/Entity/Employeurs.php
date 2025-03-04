<?php

namespace App\Entity;

use App\Entity\Traits\BaseEntityTrait;
use App\Entity\Traits\ImageAttributeTrait;
use App\Repository\EmployeursRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: EmployeursRepository::class)]
class Employeurs
{
    use BaseEntityTrait;
    use ImageAttributeTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;



    #[ORM\Column(length: 255, nullable: true)]
    private ?string $website = null;

    #[ORM\Column]
    private ?bool $favorite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): static
    {
        $this->website = $website;

        return $this;
    }

    public function isFavorite(): ?bool
    {
        return $this->favorite;
    }

    public function setFavorite(bool $isFav): static
    {
        $this->favorite = $isFav;

        return $this;
    }
}