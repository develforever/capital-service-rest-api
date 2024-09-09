<?php

use App\Entity\LoanEntity;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;

class AbstractResponse
{

    #[OA\Property(type: 'object', ref: new Model(type: AbstractResponseData::class) )]
    public object $data;

    public object $links;
}
