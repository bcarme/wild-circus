<?php

namespace App\Controller;

use App\Entity\Performance;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PerformancesViewController extends AbstractController
{
    /**
     * @Route("/performance_view", name="performance_view")
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

}
