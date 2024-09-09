<?php

use App\Model\Loans;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use OpenApi\Attributes\Items;

class LoansResponse
{
    
    #[OA\Property(type: 'array', items: new Items(type: LoansResponseData::class, ref: new Model(type: LoansResponseData::class)) )]
    public object $data;


}
