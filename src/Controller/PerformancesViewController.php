<?php

namespace App\Controller;

use App\Entity\Performance;
use App\Repository\PerformanceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PerformancesViewController extends AbstractController
{
    /**
     * @Route("/performance-view", name="performance_view")
     */
    public function index()
    {
        $performances = $this->getDoctrine()
            ->getRepository(Performance::class)
            ->findAll();
        return $this->render('performance_view/index.html.twig', [
            'performances' => $performances,
        ]);
    }

    /**

     * @return Response
     * @Route("/performance-view/{id}", name="performance_show"), methods={"GET"})
     */
    public function showOnePerformance(Performance $performance): Response
    {
        return $this->render('performance_view/show.html.twig', [
            'performance' => $performance,
        ]);
    }

}
