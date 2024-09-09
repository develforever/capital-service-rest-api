<?php

use App\Entity\LoanEntity;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;

class AbstractResponseData
{

    #[OA\Property(type: 'string' )]
    public string $type;

    #[OA\Property(type: 'integer' )]
    public int $id;

    #[OA\Property(type: 'object', ref: new Model(type: stdClass::class) )]
    public object $attributes;
}
