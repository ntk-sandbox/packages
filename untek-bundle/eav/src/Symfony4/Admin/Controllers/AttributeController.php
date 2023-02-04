<?php

namespace Untek\Bundle\Eav\Symfony4\Admin\Controllers;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Untek\Bundle\Eav\Domain\Interfaces\Services\AttributeServiceInterface;
use Untek\Bundle\Notify\Domain\Interfaces\Services\ToastrServiceInterface;
use Untek\Lib\Web\Html\Helpers\Url;
use Untek\Lib\Web\Controller\Base\BaseWebCrudController;
use Untek\Lib\Web\Controller\Interfaces\ControllerAccessInterface;
use Untek\Lib\Web\TwBootstrap\Widgets\Breadcrumb\BreadcrumbWidget;

class AttributeController extends BaseWebCrudController implements ControllerAccessInterface
{

    protected $viewsDir = __DIR__ . '/../views/attribute';
    protected $baseUri = '/eav/attribute';

    public function __construct(
        ToastrServiceInterface $toastrService,
        FormFactoryInterface $formFactory,
        CsrfTokenManagerInterface $tokenManager,
        BreadcrumbWidget $breadcrumbWidget,
        AttributeServiceInterface $service
    )
    {
        $this->setService($service);
        $this->setToastrService($toastrService);
        $this->setFormFactory($formFactory);
        $this->setTokenManager($tokenManager);
        $this->setBreadcrumbWidget($breadcrumbWidget);

        $title = 'EAV attribute';
        $this->getBreadcrumbWidget()->add($title, Url::to([$this->getBaseUri()]));
    }


}
