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
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Booking", mappedBy="show_name")
     */
    private $bookings;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Booking", mappedBy="show_date")
     */
    private $dates;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
        $this->dates = new ArrayCollection();
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
     * @return Collection|Booking[]
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings[] = $booking;
            $booking->setShowName($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->contains($booking)) {
            $this->bookings->removeElement($booking);
            // set the owning side to null (unless already changed)
            if ($booking->getShowName() === $this) {
                $booking->setShowName(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Booking[]
     */
    public function getDates(): Collection
    {
        return $this->dates;
    }

    public function addDates(Booking $dates): self
    {
        if (!$this->dates->contains($dates)) {
            $this->dates[] = $dates;
            $dates->setShowDate($this);
        }

        return $this;
    }

    public function removeDates(Booking $dates): self
    {
        if ($this->dates->contains($dates)) {
            $this->dates->removeElement($dates);
            // set the owning side to null (unless already changed)
            if ($dates->getShowDate() === $this) {
                $dates->setShowDate(null);
            }
        }

        return $this;
    }
}
