<?php

namespace Untek\Sandbox\Sandbox\Synchronize\Symfony4\Admin\Controllers;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Untek\Lib\Components\Http\Enums\HttpStatusCodeEnum;
use Untek\Component\Web\Controller\Base\BaseWebController;
use Untek\Component\Web\Controller\Interfaces\ControllerAccessInterface;
use Untek\Component\Web\Form\Libs\FormManager;
use Untek\Component\Web\Layout\Libs\LayoutManager;
use Untek\Sandbox\Sandbox\Synchronize\Domain\Interfaces\Services\SynchronizeServiceInterface;
use Untek\User\Rbac\Domain\Enums\Rbac\ExtraPermissionEnum;

class SynchronizeController extends BaseWebController implements ControllerAccessInterface
{

    protected $viewsDir = __DIR__ . '/../views/synchronize';
    protected $baseUri = '/synchronize';

    private $synchronizeService;

    public function __construct(
        FormManager $formManager,
        LayoutManager $layoutManager,
        SynchronizeServiceInterface $synchronizeService
    )
    {
        $this->setFormManager($formManager);
        $this->setLayoutManager($layoutManager);
        $this->synchronizeService = $synchronizeService;
        $title = 'Synchronize';
        // $this->getLayoutManager()->addBreadcrumb($title, $this->getBaseRoute() . '/index');
    }

    public function access(): array
    {
        return [
            'index' => [
                ExtraPermissionEnum::ADMIN_ONLY,
//                SynchronizeSynchronizePermissionEnum::ALL,
            ],
            'sync' => [
                ExtraPermissionEnum::ADMIN_ONLY,
//                SynchronizeSynchronizePermissionEnum::UPDATE,
            ],
        ];
    }

    public function index(Request $request): Response
    {
        $diffCollection = $this->synchronizeService->diff();
        return $this->render('index', [
            'diffCollection' => $diffCollection,
        ]);
    }

    public function sync(Request $request): Response
    {
        $this->synchronizeService->sync();
        $this->getLayoutManager()->getToastrService()->success(['synchronize', 'synchronize.message.sync_success']);
        $response = new RedirectResponse($this->getLayoutManager()->generateUrl('synchronize/synchronize/index'), HttpStatusCodeEnum::TEMPORARY_REDIRECT);
        return $response;
    }
}
