<?php

namespace Untek\Bundle\Storage\Symfony4\Admin\Controllers;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Untek\Bundle\Notify\Domain\Interfaces\Services\ToastrServiceInterface;
use Untek\Bundle\Storage\Domain\Interfaces\Services\FileServiceInterface;
use Untek\Bundle\Storage\Domain\Interfaces\Services\UploadServiceInterface;
use Untek\Bundle\Storage\Symfony4\Admin\Forms\FileForm;
use Untek\Core\Contract\Common\Exceptions\ReadOnlyException;
use Untek\Lib\Web\Html\Helpers\Url;
use Untek\Core\Container\Helpers\ContainerHelper;
use Untek\Model\Validator\Exceptions\UnprocessibleEntityException;
use Untek\Model\Entity\Helpers\EntityHelper;
use Untek\Lib\Web\Controller\Base\BaseWebCrudController;
use Untek\Lib\Web\Controller\Interfaces\ControllerAccessInterface;
use Untek\Lib\Web\TwBootstrap\Widgets\Breadcrumb\BreadcrumbWidget;

class FileController extends BaseWebCrudController implements ControllerAccessInterface
{

    protected $viewsDir = __DIR__ . '/../views/file';
    protected $baseUri = '/storage/file';
    protected $formClass = FileForm::class;
    protected $uploadService;

    public function __construct(
        ToastrServiceInterface $toastrService,
        FormFactoryInterface $formFactory,
        CsrfTokenManagerInterface $tokenManager,
        BreadcrumbWidget $breadcrumbWidget,
        FileServiceInterface $service,
        UploadServiceInterface $uploadService
    )
    {
        $this->setService($service);
        $this->setToastrService($toastrService);
        $this->setFormFactory($formFactory);
        $this->setTokenManager($tokenManager);
        $this->setBreadcrumbWidget($breadcrumbWidget);
        $this->uploadService = $uploadService;

        $title = 'File';
        $this->getBreadcrumbWidget()->add($title, Url::to([$this->getBaseUri()]));
    }

    protected function titleAttribute(): string
    {
        return 'name';
    }

    protected function runCreate(object $form) {
        /** @var FileForm $form */
        $this->uploadService->uploadFile($form->getServiceId(), $form->getEntityId(), $form->getFile());
    }

    public function update(Request $request): Response
    {
        throw new ReadOnlyException();
    }
}
