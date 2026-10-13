<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Guest
{
    #[ORM\Id]
    #[ORM\Column]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(length: 255, nullable: false)]
    private string $name;

    // Ein Konstruktor, der den gültigen Zustand erzwingt.
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    // Die setName() Methode fliegt komplett raus.
    // Der Name eines Gastes ändert sich nach der Zusage nicht mehr.
}
