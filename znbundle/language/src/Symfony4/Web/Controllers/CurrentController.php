<?php

namespace ZnBundle\Language\Symfony4\Web\Controllers;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use ZnBundle\Language\Domain\Enums\Rbac\LanguageCurrentPermissionEnum;
use ZnBundle\Language\Domain\Interfaces\Services\RuntimeLanguageServiceInterface;
use ZnBundle\Notify\Domain\Interfaces\Services\ToastrServiceInterface;
use ZnUser\Authentication\Domain\Interfaces\Services\AuthServiceInterface;
use ZnLib\I18Next\Facades\I18Next;
use ZnLib\Web\Controller\Base\BaseWebController;
use ZnLib\Web\Controller\Interfaces\ControllerAccessInterface;
use ZnLib\Web\Form\Traits\ControllerFormTrait;
use ZnUser\Rbac\Domain\Enums\RbacRoleEnum;

class CurrentController extends BaseWebController implements ControllerAccessInterface
{

    use ControllerFormTrait;

    protected $viewsDir = __DIR__ . '/../views/auth';
    protected $authService;
    protected $toastrService;
    protected $session;
    private $service;

    public function __construct(
        FormFactoryInterface $formFactory,
        CsrfTokenManagerInterface $tokenManager,

        RuntimeLanguageServiceInterface $service,

        ToastrServiceInterface $toastrService,
        AuthServiceInterface $authService,
        SessionInterface $session
    )
    {
        $this->setFormFactory($formFactory);
        $this->setTokenManager($tokenManager);
        $this->authService = $authService;
        $this->toastrService = $toastrService;
        $this->session = $session;
        $this->service = $service;
    }

    public function access(): array
    {
        return [
            'switch' => [
                LanguageCurrentPermissionEnum::SWITCH,
            ],
        ];
    }

    public function switch(Request $request): Response
    {
        $locale = $request->get('locale');
        $this->service->setLanguage($locale);
        $this->toastrService->success(I18Next::t('language', 'language.message.switch_success'));
        return $this->redirectToBack($request, '/');
    }
}
