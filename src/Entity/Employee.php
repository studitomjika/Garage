<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
class Employee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $firstname = null;

    /**
     * @var Collection<int, UsedCar>
     */
    #[ORM\OneToMany(targetEntity: UsedCar::class, mappedBy: 'employee')]
    private Collection $usedCars;

    public function __construct()
    {
        $this->usedCars = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name.' '.$this->firstname;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return Collection<int, UsedCar>
     */
    public function getUsedCars(): Collection
    {
        return $this->usedCars;
    }

    public function addUsedCar(UsedCar $usedCar): static
    {
        if (!$this->usedCars->contains($usedCar)) {
            $this->usedCars->add($usedCar);
            $usedCar->setEmployee($this);
        }

        return $this;
    }

    public function removeUsedCar(UsedCar $usedCar): static
    {
        if ($this->usedCars->removeElement($usedCar)) {
            // set the owning side to null (unless already changed)
            if ($usedCar->getEmployee() === $this) {
                $usedCar->setEmployee(null);
            }
        }

        return $this;
    }
}
