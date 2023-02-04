<?php

namespace Untek\Lib\Web\Controller\Interfaces;

use Symfony\Component\Form\FormBuilderInterface;

interface ControllerAccessInterface
{

    public function access(): array;
}
