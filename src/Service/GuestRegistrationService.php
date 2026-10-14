<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Guest;
use App\Form\Data\GuestRegistrationData;
use Doctrine\ORM\EntityManagerInterface;

final readonly class GuestRegistrationService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function registerGuest(GuestRegistrationData $data): void
    {
        assert(null !== $data->name);

        // 1. Mapping ausführen
        $guest = new Guest($data->name);

        // 2. In der Datenbank speichern
        $this->entityManager->persist($guest);
        $this->entityManager->flush();

        // Hier ist jetzt der perfekte Ort für Erweiterungen:
        // $this->mailer->sendConfirmation($guest);
        // $this->logger->info('Neuer Gast registriert: ' . $guest->getName());
    }
}
