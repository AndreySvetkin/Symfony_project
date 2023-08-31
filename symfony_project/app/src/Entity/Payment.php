<?php

namespace App\Entity;

use App\Repository\PaymentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentRepository::class)]
class Payment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?float $sum = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Guest $createPaymentGuest = null;

    #[ORM\ManyToOne]
    private ?Guest $receivedPaymentGuest = null;

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getSum(): ?float
    {
        return $this->sum;
    }

    public function setSum(float $sum): static
    {
        $this->sum = $sum;

        return $this;
    }

    public function getCreatePaymentGuest(): ?Guest
    {
        return $this->createPaymentGuest;
    }

    public function setCreatePaymentGuest(?Guest $createPaymentGuest): static
    {
        $this->createPaymentGuest = $createPaymentGuest;

        return $this;
    }

    public function getReceivedPaymentGuest(): ?Guest
    {
        return $this->receivedPaymentGuest;
    }

    public function setReceivedPaymentGuest(?Guest $receivedPaymentGuest): static
    {
        $this->receivedPaymentGuest = $receivedPaymentGuest;

        return $this;
    }
}
