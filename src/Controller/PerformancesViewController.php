<?php

namespace App\Controller;

use App\Entity\Performance;
use App\Form\SearchPerfType;
use App\Repository\PerformanceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PerformancesViewController extends AbstractController
{
    /**
     * @Route("/performance-view", name="performance_view")
     * @param Request $request
     * @return Response
     */
    public function index(PerformanceRepository $performanceRepository, Request $request): Response
    {
        $performances = $this->getDoctrine()
            ->getRepository(Performance::class)
            ->findAll();

        $form = $this->createForm(SearchPerfType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $search = $data['search'];
            $performances =  $performanceRepository->searchByName($search);
        }
        return $this->render('performance_view/index.html.twig', [
            'performances' => $performances,
            'form' => $form->createView(),
        ]);
    }

    /**

     * @return Response
     * @Route("/performance-view/{id}", name="performance_one"), methods={"GET"})
     */
    public function showOnePerformance(Performance $performance): Response
    {
        return $this->render('performance_view/show.html.twig', [
            'performance' => $performance,
        ]);
    }

}
