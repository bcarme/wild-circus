<?php

namespace App\Controller;

use App\Entity\Performance;
use App\Form\PerformanceType;
use App\Repository\PerformanceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin/performance")
 */
class AdminPerformanceController extends AbstractController
{
    /**
     * @Route("/", name="admin_performance_index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN", message="access denied")
     */
    public function index(PerformanceRepository $performanceRepository): Response
    {
        return $this->render('admin_performance/index.html.twig', [
            'performances' => $performanceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_performance_new", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN", message="access denied")
     */
    public function new(Request $request): Response
    {
        $performance = new Performance();
        $form = $this->createForm(PerformanceType::class, $performance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($performance);
            $entityManager->flush();

            return $this->redirectToRoute('admin_performance_index');
        }

        return $this->render('admin_performance/new.html.twig', [
            'performance' => $performance,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_performance_show", methods={"GET"})
     * @IsGranted("ROLE_ADMIN", message="access denied")
     */
    public function show(Performance $performance): Response
    {
        return $this->render('admin_performance/show.html.twig', [
            'performance' => $performance,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_performance_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN", message="access denied")
     */
    public function edit(Request $request, Performance $performance): Response
    {
        $form = $this->createForm(PerformanceType::class, $performance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_performance_index');
        }

        return $this->render('admin_performance/edit.html.twig', [
            'performance' => $performance,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_performance_delete", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN", message="access denied")
     */
    public function delete(Request $request, Performance $performance): Response
    {
        if ($this->isCsrfTokenValid('delete'.$performance->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($performance);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_performance_index');
    }
}
