<?php

use App\Entity\LoanEntity;
use App\Model\Loans;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;

class LoansResponseData extends AbstractResponseData
{

    public string $type = 'loans';

    #[OA\Property(type: 'object', ref: new Model(type: Loans::class) )]
    public object $attributes;
}
