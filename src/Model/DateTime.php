<?php

namespace App\Model;

use App\Entity\LoanEntity;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;

class DateTime {

    
    #[OA\Property(type: 'string')]
    public int $date;

    #[OA\Property(type: 'integer')]
    public object $timezone_type;

    #[OA\Property(type: 'string')]
    public object $timezone;

}