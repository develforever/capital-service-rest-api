<?php

namespace App\Controller;

use App\Config\Versions;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Choice;


class LoanController extends AbstractFOSRestController
{
    #[Rest\View()]
    #[Rest\Get('/loan', name: 'index')]
    #[QueryParam(
        name: 'version',
        requirements: '1.0',
        description: 'API version 1.0',
        nullable: false,
        strict: true,
    )]
    public function index(Request $request)
    {
        
        $version = $request->attributes->get('version');

        return [
            'version' => 'version='.$version
        ];
    }
}
