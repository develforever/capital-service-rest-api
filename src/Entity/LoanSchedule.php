<?php

namespace App\Entity;

use App\Repository\LoanScheduleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use JsonSerializable;

#[ORM\Entity(repositoryClass: LoanScheduleRepository::class)]
class LoanSchedule implements JsonSerializable
{

    use TimestampableEntity;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nr = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $amount = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $interest = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $fund = null;

    #[ORM\ManyToOne(inversedBy: 'loanSchedules')]
    private ?LoanEntity $loan_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNr(): ?int
    {
        return $this->nr;
    }

    public function setNr(int $nr): static
    {
        $this->nr = $nr;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function getInterest(): ?string
    {
        return $this->interest;
    }

    public function setInterest(string $interest): static
    {
        $this->interest = $interest;

        return $this;
    }

    public function getFund(): ?string
    {
        return $this->fund;
    }

    public function setFund(string $fund): static
    {
        $this->fund = $fund;

        return $this;
    }

    public function getLoanId(): ?LoanEntity
    {
        return $this->loan_id;
    }

    public function setLoanId(?LoanEntity $loan_id): static
    {
        $this->loan_id = $loan_id;

        return $this;
    }

    public function jsonSerialize():array {

        $out = get_object_vars($this);
        return $out;
    }
}
