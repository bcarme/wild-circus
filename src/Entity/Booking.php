<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingRepository")
 */
class Booking
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $ticket_number;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ticket", inversedBy="bookings")
     */
    private $show_name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ticket", inversedBy="dates")
     */
    private $show_date;
    /**
     * @var user|null
     */


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTicketNumber(): ?int
    {
        return $this->ticket_number;
    }

    public function setTicketNumber(int $ticket_number): self
    {
        $this->ticket_number = $ticket_number;

        return $this;
    }

    public function getShowName(): ?Ticket
    {
        return $this->show_name;
    }

    public function setShowName(?Ticket $show_name): self
    {
        $this->show_name = $show_name;

        return $this;
    }

    public function getShowDate(): ?Ticket
    {
        return $this->show_date;
    }

    public function setShowDate(?Ticket $show_date): self
    {
        $this->show_date = $show_date;

        return $this;
    }
}
