<?php

namespace App\Entity;

use App\Repository\UsedCarRepository;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: UsedCarRepository::class)]
#[ApiResource(
    shortName: 'Voiture d\'occasion',
    description: 'Trouver des voitures d\'occasion',
    operations: [
        new Get(normalizationContext: ['groups' => 'usedcar:item']),
        new GetCollection(normalizationContext: ['groups' => 'usedcar:list'])
    ],
    paginationEnabled: false,
)]
class UsedCar
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['usedcar:list', 'usedcar:item'])]
    private ?int $id = null;

    #[Groups(['usedcar:list', 'usedcar:item'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $model = null;

    #[Groups(['usedcar:list', 'usedcar:item'])]
    #[ApiFilter(RangeFilter::class)]
    #[ORM\Column(nullable: true)]
    private ?int $kilometers = null;

    #[Groups(['usedcar:list', 'usedcar:item'])]
    #[ApiFilter(RangeFilter::class)]
    #[ORM\Column(nullable: true)]
    private ?int $year = null;

    #[Groups(['usedcar:list', 'usedcar:item'])]
    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    #[ApiFilter(RangeFilter::class)]
    private ?string $price = null;

    #[Groups(['usedcar:list', 'usedcar:item'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pictureFilename = null;

    #[ORM\ManyToOne(inversedBy: 'usedCars')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Employee $employee = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(?string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getKilometers(): ?int
    {
        return $this->kilometers;
    }

    public function setKilometers(?int $kilometers): static
    {
        $this->kilometers = $kilometers;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getPictureFilename(): ?string
    {
        return $this->pictureFilename;
    }

    public function setPictureFilename(?string $pictureFilename): static
    {
        $this->pictureFilename = $pictureFilename;

        return $this;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(?Employee $employee): static
    {
        $this->employee = $employee;

        return $this;
    }
}
