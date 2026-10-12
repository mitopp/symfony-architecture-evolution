<?php

namespace App\Controller;

use App\Entity\Guest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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

        // Formular direkt im Controller bauen
        $form = $this->createFormBuilder($guest)
            ->add('name', TextType::class, [
                'label' => 'Dein Name',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Ich bin dabei!',
            ])
            ->getForm()
        ;

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
