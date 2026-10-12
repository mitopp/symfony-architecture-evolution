<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Guest;
use App\Form\GuestType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RsvpController extends AbstractController
{
    public const string ROUTE_NAME = 'app_rsvp';

    #[Route(path: '/rsvp', name: self::ROUTE_NAME)]
    public function __invoke(Request $request, EntityManagerInterface $entityManager): Response
    {
        $guest = new Guest();

        // Wir erstellen das Formular nun mit der Form-Klasse!
        $form = $this->createForm(GuestType::class, $guest);

        // Request verarbeiten
        $form->handleRequest($request);

        // Validieren und verarbeiten
        if ($form->isSubmitted() && $form->isValid()) {
            // Speichern in der Datenbank
            $entityManager->persist($guest);
            $entityManager->flush();

            // Rückmeldung
            $this->addFlash('success', 'Vielen Dank für deine Teilnahme!');

            // Redirect
            return $this->redirectToRoute(self::ROUTE_NAME);
        }

        // Template rendern
        return $this->render('page/rsvp/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
