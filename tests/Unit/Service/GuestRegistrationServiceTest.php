<?php

declare(strict_types=1);

namespace App\Tests\Unit\Service;

use App\Form\Data\GuestRegistrationData;
use App\Service\GuestRegistrationService;
use App\Tests\Unit\Repository\InMemoryGuestRepository;
use PHPUnit\Framework\TestCase;

final class GuestRegistrationServiceTest extends TestCase
{
    public function testGuestIsRegisteredSuccessfully(): void
    {
        $repository = new InMemoryGuestRepository();
        $service = new GuestRegistrationService($repository);

        $dto = new GuestRegistrationData();
        $dto->name = 'Max Mustermann';

        $service->registerGuest($dto);

        self::assertCount(1, $guests = $repository->guests);
        self::assertSame('Max Mustermann', $guests[0]->getName());
    }
}
