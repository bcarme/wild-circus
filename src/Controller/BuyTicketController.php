<?php

namespace App\Controller;

use App\Entity\Performance;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BuyTicketController extends AbstractController
{
    /**
     * @Route("/buy_ticket", name="buy_ticket")
     */
    public function index()
    {
        $performances = $this->getDoctrine()
            ->getRepository(Performance::class)
            ->findAll();
        return $this->render('buy_ticket/index.html.twig', [
            'performances' => $performances,
        ] );
    }
}
