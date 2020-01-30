<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookingRepository;
use App\Entity\Performance;
use App\Repository\PerformanceRepository;
use App\Repository\TicketRepository;
use App\Entity\Ticket;
use App\Form\BookType;
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
        $performances = $this->getDoctrine()
            ->getRepository(Performance::class)
            ->findAll();
        $tickets = $this->getDoctrine()
            ->getRepository(Ticket::class)
            ->findAll();


        return $this->render('buy_ticket/index.html.twig', [
            'performances' => $performances,
            'tickets' => $tickets,
        ]);

        /**
         * @Route("/buy-ticket/{ticket}", name="buy_ticket")
         */
        public
        function index(Ticket $ticket, Request $request): Response
        {
            $performance = $this->getDoctrine()
                ->getRepository(Performance::class)
                ->find();
            $ticket = $this->getDoctrine()
                ->getRepository(Ticket::class)
                ->find();


            return $this->render('buy_ticket/index.html.twig', [
                'performance' => $performance,
                'ticket' => $ticket,
            ]);

        }


    }

}
