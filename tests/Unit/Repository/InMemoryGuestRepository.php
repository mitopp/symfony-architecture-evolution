<?php

declare(strict_types=1);

namespace App\Tests\Unit\Repository;

use App\Entity\Guest;
use App\Repository\GuestRepositoryInterface;

final class InMemoryGuestRepository implements GuestRepositoryInterface
{
    /**
     * @var array<Guest>
     */
    public array $guests = [];

    public function save(Guest $guest): void
    {
        $this->guests[] = $guest;
    }

    public function findAll(): array
    {
        return $this->guests;
    }
}
