<?php

namespace App\Entity;

use App\Repository\LoanEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LoanEntityRepository::class)]
class LoanEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $installments = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $amount = null;

    /**
     * @var Collection<int, LoanSchedule>
     */
    #[ORM\OneToMany(targetEntity: LoanSchedule::class, mappedBy: 'loan_id')]
    private Collection $loanSchedules;

    public function __construct()
    {
        $this->loanSchedules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInstallments(): ?int
    {
        return $this->installments;
    }

    public function setInstallments(int $installments): static
    {
        $this->installments = $installments;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

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

    /**
     * @return Collection<int, LoanSchedule>
     */
    public function getLoanSchedules(): Collection
    {
        return $this->loanSchedules;
    }

    public function addLoanSchedule(LoanSchedule $loanSchedule): static
    {
        if (!$this->loanSchedules->contains($loanSchedule)) {
            $this->loanSchedules->add($loanSchedule);
            $loanSchedule->setLoanId($this);
        }

        return $this;
    }

    public function removeLoanSchedule(LoanSchedule $loanSchedule): static
    {
        if ($this->loanSchedules->removeElement($loanSchedule)) {
            // set the owning side to null (unless already changed)
            if ($loanSchedule->getLoanId() === $this) {
                $loanSchedule->setLoanId(null);
            }
        }

        return $this;
    }
}
