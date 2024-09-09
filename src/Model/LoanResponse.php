<?php

use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;

class LoanResponse extends AbstractResponse
{
    
    #[OA\Property(type: 'object', ref: new Model(type: LoanResponseData::class) )]
    public object $data;
}
