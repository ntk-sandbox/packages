<?php

namespace Untek\Sandbox\Sandbox\Application\Symfony4\Admin\Controllers;

use Untek\Sandbox\Sandbox\Application\Domain\Filters\ApiKeyFilter;
use Untek\Sandbox\Sandbox\Application\Domain\Interfaces\Services\ApiKeyServiceInterface;
use Untek\Sandbox\Sandbox\Application\Domain\Interfaces\Services\EdsServiceInterface;
use Untek\Sandbox\Sandbox\Application\Symfony4\Admin\Forms\ApiKeyForm;
use Untek\Sandbox\Sandbox\Application\Symfony4\Admin\Forms\EdsForm;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Untek\Bundle\Notify\Domain\Interfaces\Services\ToastrServiceInterface;
use Untek\Lib\Web\Html\Helpers\Url;
use Untek\Lib\Web\Controller\Base\BaseWebCrudController;
use Untek\Lib\Web\Controller\Interfaces\ControllerAccessInterface;
use Untek\Lib\Web\TwBootstrap\Widgets\Breadcrumb\BreadcrumbWidget;

class EdsController extends BaseWebCrudController implements ControllerAccessInterface
{

    protected $viewsDir = __DIR__ . '/../views/eds';
    protected $baseUri = '/application/eds';
    protected $formClass = EdsForm::class;

    public function __construct(
        ToastrServiceInterface $toastrService,
        FormFactoryInterface $formFactory,
        CsrfTokenManagerInterface $tokenManager,
        BreadcrumbWidget $breadcrumbWidget,
        EdsServiceInterface $service
    )
    {
        $this->setService($service);
        $this->setToastrService($toastrService);
        $this->setFormFactory($formFactory);
        $this->setTokenManager($tokenManager);
        $this->setBreadcrumbWidget($breadcrumbWidget);

        $this->setFilterModel(ApiKeyFilter::class);

        $title = 'application eds';
        $this->getBreadcrumbWidget()->add($title, Url::to([$this->getBaseUri()]));
    }

    public function with(): array
    {
        return [
            'application',
        ];
    }
}
