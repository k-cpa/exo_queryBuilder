<?php

namespace App\Entity;

use App\Repository\RaceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RaceRepository::class)]
class Race
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $race_name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRaceName(): ?string
    {
        return $this->race_name;
    }

    public function setRaceName(string $race_name): static
    {
        $this->race_name = $race_name;

        return $this;
    }
}
