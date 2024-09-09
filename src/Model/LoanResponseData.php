<?php

use App\Entity\LoanEntity;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;

class LoanResponseData extends AbstractResponseData
{

    public string $type = 'loan';

    #[OA\Property(type: 'object', ref: new Model(type: LoanEntity::class) )]
    public object $attributes;
}
