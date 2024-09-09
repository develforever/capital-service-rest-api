<?php

namespace App\Model;

use App\Entity\LoanEntity;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;

class Loans {

    
    #[OA\Property(type: 'integer')]
    public int $id;

    #[OA\Property(type: 'integer')]
    public object $amount;

    #[OA\Property(type: 'integer')]
    public object $interest_sum;

    #[OA\Property(type: 'object', ref: new Model(type: DateTime::class))]
    public object $createdAt;

    #[OA\Property(type: 'object', ref: new Model(type: DateTime::class))]
    public object $updatedAt;



}