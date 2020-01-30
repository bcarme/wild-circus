<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Entity\Performance;
use App\Repository\PerformanceRepository;
use App\Repository\TicketRepository;
use App\Entity\Ticket;
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


        $book = new Book();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $book->setAuthor($this->getUser());
            $book->setTicket();
            $book->setQuantity();
            $book->setTicket();
            $entityManager->persist($book);
            $entityManager->flush();
            return $this->redirectToRoute('buy_ticket');
        }

        return $this->render('buy_ticket/index.html.twig', [
            'performances' => $performances,
            'tickets' => $tickets,
            'form' =>$form->createView()
        ]);
    }

      }

