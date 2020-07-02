<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TicketRepository")
 */
class Ticket
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Performance", inversedBy="title")
     */
    private $performanceName;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="time")
     */
    private $hour;


    /**
     * @ORM\Column(type="float")
     */
    private $price;


    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $capacityMax;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BookTicket", mappedBy="ticket")
     */
    private $bookTickets;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbTicketSold;


    /**
     * @return mixed
     */
    public function getCapacityMax()
    {
        return $this->capacityMax;
    }

    /**
     * @param mixed $capacityMax
     */
    public function setCapacityMax($capacityMax): void
    {
        $this->capacityMax = $capacityMax;
    }

    public function __construct()
    {
        $this->bookTickets = new ArrayCollection();
        $this->nbTicketSold = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPerformanceName(): ?Performance
    {
        return $this->performanceName;
    }

    public function setPerformanceName(?Performance $performanceName): self
    {
        $this->performanceName = $performanceName;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getHour()
    {
        return $this->hour;
    }

    /**
     * @param mixed $hour
     */
    public function setHour($hour): void
    {
        $this->hour = $hour;
    }

    /**
     * @return Collection|BookTicket[]
     */
    public function getBookTickets(): Collection
    {
        return $this->bookTickets;
    }

    public function addBookTicket(BookTicket $bookTicket): self
    {
        if (!$this->bookTickets->contains($bookTicket)) {
            $this->bookTickets[] = $bookTicket;
            $bookTicket->setTicket($this);
        }

        return $this;
    }

    public function removeBookTicket(BookTicket $bookTicket): self
    {
        if ($this->bookTickets->contains($bookTicket)) {
            $this->bookTickets->removeElement($bookTicket);
            // set the owning side to null (unless already changed)
            if ($bookTicket->getTicket() === $this) {
                $bookTicket->setTicket(null);
            }
        }

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getNbTicketSold(): ArrayCollection
    {
        return $this->nbTicketSold;
    }

    /**
     * @param ArrayCollection $nbTicketSold
     */
    public function setNbTicketSold(ArrayCollection $nbTicketSold): void
    {
        $this->nbTicketSold = $nbTicketSold;
    }

}
