<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class LoanAmoutConstraintsValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof LoanAmoutConstraints) {
            throw new UnexpectedTypeException($constraint, LoanAmoutConstraints::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if($value % 500 !== 0){
            $this->context->buildViolation($constraint->message2)
            ->setParameter('{{ amount }}', $value)
            ->addViolation();
        }

        
    }
}
