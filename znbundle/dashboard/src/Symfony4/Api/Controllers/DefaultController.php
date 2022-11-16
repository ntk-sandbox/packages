<?php

namespace ZnBundle\Dashboard\Symfony4\Api\Controllers;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends AbstractController
{

    public function needVersion()
    {
        return new JsonResponse([
            'Message' => 'Please enter the API version in the URL!',
        ], 400);
    }

    public function needEndpoint()
    {
        return new JsonResponse([
            'Message' => 'Please enter the resource endpoint in the URL!',
        ], 400);
    }

}
