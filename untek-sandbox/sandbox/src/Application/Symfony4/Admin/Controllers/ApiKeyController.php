<?php

namespace Untek\Sandbox\Sandbox\Application\Symfony4\Admin\Controllers;

use Untek\Sandbox\Sandbox\Application\Domain\Filters\ApiKeyFilter;
use Untek\Sandbox\Sandbox\Application\Domain\Interfaces\Services\ApiKeyServiceInterface;
use Untek\Sandbox\Sandbox\Application\Symfony4\Admin\Forms\ApiKeyForm;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Untek\Bundle\Notify\Domain\Interfaces\Services\ToastrServiceInterface;
use Untek\Component\Web\Html\Helpers\Url;
use Untek\Component\Web\Controller\Base\BaseWebCrudController;
use Untek\Component\Web\Controller\Interfaces\ControllerAccessInterface;
use Untek\Component\Web\TwBootstrap\Widgets\Breadcrumb\BreadcrumbWidget;

class ApiKeyController extends BaseWebCrudController implements ControllerAccessInterface
{

    protected $viewsDir = __DIR__ . '/../views/api-key';
    protected $baseUri = '/application/api-key';
    protected $formClass = ApiKeyForm::class;

    public function __construct(
        ToastrServiceInterface $toastrService,
        FormFactoryInterface $formFactory,
        CsrfTokenManagerInterface $tokenManager,
        BreadcrumbWidget $breadcrumbWidget,
        ApiKeyServiceInterface $service
    )
    {
        $this->setService($service);
        $this->setToastrService($toastrService);
        $this->setFormFactory($formFactory);
        $this->setTokenManager($tokenManager);
        $this->setBreadcrumbWidget($breadcrumbWidget);

        $this->setFilterModel(ApiKeyFilter::class);

        $title = 'application api key';
        $this->getBreadcrumbWidget()->add($title, Url::to([$this->getBaseUri()]));
    }

    public function with(): array
    {
        return [
            'application',
        ];
    }
}
