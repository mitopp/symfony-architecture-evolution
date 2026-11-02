<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Guest;
use Symfony\Component\DependencyInjection\Attribute\AsDecorator;
use Symfony\Component\DependencyInjection\Attribute\AutowireDecorated;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

// Wir sagen Symfony: "Lege dich wie ein Mantel um das originale GuestRepository!"
#[AsDecorator(decorates: GuestRepository::class)]
final readonly class CachedGuestRepository implements GuestRepositoryInterface
{
    public function __construct(
        // Wir lassen uns das Original-Repository übergeben
        #[AutowireDecorated] private GuestRepositoryInterface $guestRepository,
        private CacheInterface $cache,
    ) {
    }

    public function save(Guest $guest): void
    {
        // 1. Speichern im echten Repository
        $this->guestRepository->save($guest);

        // 2. Cache sofort löschen, damit die Liste aktuell bleibt!
        $this->cache->delete('guest_list');
    }

    public function findAll(): array
    {
        // Wir fragen den Cache. Nur wenn er leer ist, rufen wir die Datenbank auf.
        return $this->cache->get('guest_list', function (ItemInterface $item): array {
            $item->expiresAfter(3600); // 1 Stunde im Cache behalten

            return $this->guestRepository->findAll();
        });
    }
}
