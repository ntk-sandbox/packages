<?php

namespace ZnBundle\Dashboard\Symfony4\Web\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EmptyDashboardController
{

    public string $content = 'Empty dashboard!';

    public function index(Request $request): Response
    {
        return new Response($this->content);
    }
}
