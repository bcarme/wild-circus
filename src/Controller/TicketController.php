<?php

namespace App\Controller;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Form\BookTicketType;
use App\Entity\BookTicket;
use App\Entity\Performance;
use App\Repository\PerformanceRepository;
use App\Repository\TicketRepository;
use App\Entity\Ticket;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class TicketController extends AbstractController
{
        /**
         * @Route("/buy-ticket", name="buy_ticket")
         * @param Request $request
         * @return Response
         */
        public function index(Request $request): Response {
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
    }

   }

