<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class LoanInstallmentsConstraints extends Constraint
{
    public string $message = 'The installments "{{ installments }}" is not valid. Allowed values are from range 3 to 18 multipled by {{ multiplier }}.';
    public string $message2 = 'The installments "{{ installments }}" is not multiplier of {{ multiplier }}.';
    public $multiplier = 3;
    
    public function __construct(?int $multiplier, ?string $message = null, ?array $groups = null, $payload = null)
    {
        parent::__construct([], $groups, $payload);

        $this->message = $message ?? $this->message;
        $this->multiplier = $multiplier ?? $this->multiplier;
    }
}