<?php

use App\Entity\LoanEntity;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;

class LoanResponse
{

    #[OA\Property(type: 'object', ref: new Model(type: LoanEntity::class) )]
    public $loan;
}
