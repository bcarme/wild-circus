<?php

namespace App\Controller;

use App\Entity\Performance;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PerformanceController extends AbstractController
{
    /**
     * @Route("/performance", name="performance")
     */
    public function index()
    {
        $performances = $this->getDoctrine()
            ->getRepository(Performance::class)
            ->findAll();
        return $this->render('performance/index.html.twig', [
            'performances' => $performances,
        ]);
    }

}
