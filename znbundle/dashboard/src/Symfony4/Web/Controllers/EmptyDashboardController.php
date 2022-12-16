<?php

namespace ZnBundle\Dashboard\Symfony4\Web\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EmptyDashboardController
{

    public function index(Request $request): Response
    {
//        throw new \Exception('Empty dashboard!');
        return new Response('Empty dashboard!');
    }
}
