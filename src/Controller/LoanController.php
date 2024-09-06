<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Areas;
use Symfony\Component\HttpFoundation\Request;


#[Areas(['v1'])]
class LoanController extends AbstractFOSRestController
{

    #[Rest\View()]
    #[Rest\Get('/', name: 'v1_index')]
    public function index(Request $request)
    {

        return [
            'data' => 'data'
        ];
    }

    #[Rest\View()]
    #[Rest\Get('/loan', name: 'v1_loan')]
    public function loan(Request $request)
    {


        return [
            'data'    => 'data'
        ];
    }
}
