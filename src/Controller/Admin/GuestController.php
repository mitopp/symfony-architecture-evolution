<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Guest;
use App\Repository\GuestRepository;
use App\View\GuestListItem;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class GuestController extends AbstractController
{
    public const string ROUTE_NAME = 'app_admin_guests';

    #[Route(path: '/admin/guests', name: self::ROUTE_NAME)]
    public function __invoke(GuestRepository $repository): Response
    {
        $entities = $repository->findAll();

        // Mapping: Von der Entity zum View-DTO
        $guests = array_map(fn (Guest $entity): GuestListItem => new GuestListItem($entity->getName()), $entities);

        return $this->render('page/guest/admin/index.html.twig', [
            // Twig bekommt nur die dummen DTOs!
            'guests' => $guests,
        ]);
    }
}
