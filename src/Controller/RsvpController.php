<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\Data\GuestRegistrationData;
use App\Form\GuestType;
use App\Service\GuestRegistrationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RsvpController extends AbstractController
{
    public const string ROUTE_NAME = 'app_rsvp';

    #[Route(path: '/rsvp', name: self::ROUTE_NAME)]
    public function __invoke(Request $request, GuestRegistrationService $registrationService): Response
    {
        // 1. Wir starten mit einem leeren DTO statt einer Entität
        $dto = new GuestRegistrationData();
        $form = $this->createForm(GuestType::class, $dto);

        // Request verarbeiten
        $form->handleRequest($request);

        // Validieren und verarbeiten
        if ($form->isSubmitted() && $form->isValid()) {
            // Magie auslagern! Der Controller delegiert nur noch.
            $registrationService->registerGuest($dto);

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
