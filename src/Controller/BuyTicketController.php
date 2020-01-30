<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Repository\BookingRepository;
use App\Entity\Performance;
use App\Repository\PerformanceRepository;
use App\Repository\TicketRepository;
use App\Entity\Ticket;
use App\Form\BookingType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class BuyTicketController extends AbstractController
{
    /**
     * @Route("/buy-ticket", name="buy_ticket")
     */
    public function index(Request $request): Response
        
    {
        $booking = new Booking();
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $booking->setName();
            $booking->setAuthor($this->getUser());
            $booking->setTicketNumber();
            $booking->setShowName($this->getTitle());
            $entityManager->persist($booking);
            $entityManager->flush();
            return $this->redirectToRoute('home');
        }
        $performances = $this->getDoctrine()
            ->getRepository(Performance::class)
            ->findAll();
        $tickets = $this->getDoctrine()
            ->getRepository(Ticket::class)
            ->findAll();


        return $this->render('buy_ticket/index.html.twig', [
            'performances' => $performances,
            'tickets' => $tickets,
            'form' => $form->createView(),
        ]);

    }

    private function getAuthor()
    {
    }
}
