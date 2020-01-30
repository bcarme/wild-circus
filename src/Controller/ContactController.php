<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     * @param Request $request
     * @param MailerInterface $mailer
     * @return Response
     * @throws TransportExceptionInterface
     */
    public function index(
        Request $request,
        MailerInterface $mailer): Response {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $dataContact = $form->getData();
            $email = (new Email())
                ->from($this->getParameter('mailer_from'))
                ->to($this->getParameter('mailer_from'))
                ->subject('You have received a message.')
                ->html($this->renderView('emails/contact.html.twig', [
                    'dataContact' => $dataContact
                ]));
            $mailer->send($email);
            $this->addFlash('success', 'Your message was sent');
            return $this->redirect('contact');
        }



        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
