<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class LoanInstallmentsConstraintsValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof LoanInstallmentsConstraints) {
            throw new UnexpectedTypeException($constraint, LoanInstallmentsConstraints::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if($value % 3 !== 0){
            $this->context->buildViolation($constraint->message2)
            ->setParameter('{{ installments }}', $value)
            ->setParameter('{{ multiplier }}', $constraint->multiplier)
            ->addViolation();
        }
    }
}
