<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\LoanAmoutConstraints;
use App\Validator\LoanInstallmentsConstraints;

class LoanRequestDTO
{
    public function __construct(

        #[Assert\GreaterThanOrEqual(1000)]
        #[Assert\LessThanOrEqual(12000)]
        #[LoanAmoutConstraints()]
        public readonly int $amount,

        #[Assert\GreaterThanOrEqual(3)]
        #[Assert\LessThanOrEqual(18)]
        #[LoanInstallmentsConstraints(3)]
        public readonly int $installments,
    ) {
    }
}