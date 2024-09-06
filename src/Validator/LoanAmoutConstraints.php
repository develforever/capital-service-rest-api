<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class LoanAmoutConstraints extends Constraint
{
    public string $message = 'The amount "{{ amount }}" is not valid. Allowed values are from range 1000 to 12000 multipled of 500.';

    public string $message2 = 'The amount "{{ amount }}" is not multipler of 500.';

    
    public function __construct(?string $message = null, ?array $groups = null, $payload = null)
    {
        parent::__construct([], $groups, $payload);

        $this->message = $message ?? $this->message;
    }
}