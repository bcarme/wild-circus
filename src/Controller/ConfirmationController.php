<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Entity\BookTicket;
use App\Form\BookTicketType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Response\QrCodeResponse;
use Dompdf\Dompdf;
use Dompdf\Options;


class ConfirmationController extends AbstractController
{
    /**
     * @Route("/confirmation", name="confirmation")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $bookticket = new BookTicket();
        $form = $this->createForm(BookTicketType::class, $bookticket);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bookticket);
            $entityManager->flush();


            //booking code
            $random_hash = substr(md5(uniqid(rand(), true)), 8, 8);

            // Instantiate Dompdf PDF with our options
            $pdfOptions = new Options();
            $pdfOptions->setIsRemoteEnabled(true);
            $dompdf = new Dompdf($pdfOptions);
            $html = $this->renderView('confirmation/mypdf.html.twig', [
                'title' => "Your e-ticket",
                'bookticket'=>$bookticket,
                'random'=>$random_hash
            ]);
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream("mypdf.pdf", [
                "Attachment" => true
            ]);
            return $this->redirectToRoute('confirmation');

        }
        return $this->render('confirmation/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/confirmation/pdf", name="my_pdf")
     */
    public function generatePdf()
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('confirmation/mypdf.html.twig', [
            'title' => "Your e-ticket"
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);
    }


}
