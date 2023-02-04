<?php

namespace Untek\User\Rbac\Symfony4\Admin\Controllers;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Untek\Bundle\Log\Domain\Interfaces\Services\HistoryServiceInterface;
use Untek\Bundle\Notify\Domain\Interfaces\Services\ToastrServiceInterface;
use Untek\Lib\Web\Html\Helpers\Url;
use Untek\Lib\Web\Controller\Base\BaseWebCrudController;
use Untek\Lib\Web\Controller\Interfaces\ControllerAccessInterface;
use Untek\Lib\Web\TwBootstrap\Widgets\Breadcrumb\BreadcrumbWidget;

class HistoryController extends BaseWebCrudController implements ControllerAccessInterface
{

    protected $viewsDir = __DIR__ . '/../views/history';
    protected $baseUri = '/log/history';

    public function __construct(
        ToastrServiceInterface $toastrService,
        FormFactoryInterface $formFactory,
        CsrfTokenManagerInterface $tokenManager,
        BreadcrumbWidget $breadcrumbWidget,
        HistoryServiceInterface $service
    )
    {
        $this->setService($service);
        $this->setToastrService($toastrService);
        $this->setFormFactory($formFactory);
        $this->setTokenManager($tokenManager);
        $this->setBreadcrumbWidget($breadcrumbWidget);

        $title = 'Log history';
        $this->getBreadcrumbWidget()->add($title, Url::to([$this->getBaseUri()]));
    }

    protected function titleAttribute(): string
    {
        return 'message';
    }
}
