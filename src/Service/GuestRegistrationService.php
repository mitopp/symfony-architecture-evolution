<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Guest;
use App\Form\Data\GuestRegistrationData;
use App\Repository\GuestRepositoryInterface;

final readonly class GuestRegistrationService
{
    public function __construct(
        private GuestRepositoryInterface $guestRepository,
    ) {
    }

    public function registerGuest(GuestRegistrationData $data): void
    {
        assert(null !== $data->name);

        // 1. Mapping ausführen
        $guest = new Guest($data->name);

        // 2. In der Datenbank speichern
        $this->guestRepository->save($guest);

        // Hier ist jetzt der perfekte Ort für Erweiterungen:
        // $this->mailer->sendConfirmation($guest);
        // $this->logger->info('Neuer Gast registriert: ' . $guest->getName());
    }
}
