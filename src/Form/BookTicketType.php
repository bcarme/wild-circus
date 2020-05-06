<?php

namespace App\Form;

use App\Entity\Ticket;
use App\Entity\BookTicket;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class BookTicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           ->add('ticket', EntityType::class, [
                'class' => Ticket::class,
               'choice_label' => function ($ticket) {
                   return $ticket->getPerformanceName()->getTitle() . ' - ' .  $ticket->getDate()->format('d M Y')  . ' ('. str_replace('.', ',',$ticket->getPrice()) . ' €)';
               },
               'label' => false
           ])
            ->add('firstname')
            ->add('lastname')
            ->add('email')
            ->add('quantity')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BookTicket::class,
        ]);
    }
}
