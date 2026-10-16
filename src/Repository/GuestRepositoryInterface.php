<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Guest;

interface GuestRepositoryInterface
{
    public function save(Guest $guest): void;

    /**
     * @return array<Guest>
     */
    public function findAll(): array;
}
