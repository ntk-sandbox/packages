<?php

namespace Untek\User\Password\Symfony4\Web\Controllers;

use Untek\User\Password\Domain\Forms\CreatePasswordForm;
use Untek\User\Password\Domain\Forms\RequestActivationCodeForm;
use Untek\User\Password\Domain\Forms\UpdatePasswordForm;
use Untek\User\Password\Domain\Interfaces\Services\RestorePasswordServiceInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Untek\Bundle\Notify\Domain\Interfaces\Services\ToastrServiceInterface;
use Untek\Domain\Entity\Exceptions\AlreadyExistsException;
use Untek\Lib\I18Next\Facades\I18Next;
use Untek\Domain\Validator\Exceptions\UnprocessibleEntityException;
use Untek\Lib\Web\Controller\Base\BaseWebController;
use Untek\Lib\Web\Controller\Interfaces\ControllerAccessInterface;
use Untek\Lib\Web\Form\Traits\ControllerFormTrait;
use Untek\User\Password\Domain\Enums\Rbac\SecurityPermissionEnum;
use Untek\User\Password\Domain\Interfaces\Services\UpdatePasswordServiceInterface;
use Untek\User\Password\Symfony4\Web\Enums\WebUserSecurityEnum;

class UpdatePasswordController extends BaseWebController implements ControllerAccessInterface
{

    use ControllerFormTrait;

    protected $viewsDir = __DIR__ . '/../views/update-password';
    protected $toastrService;
    protected $service;
    protected $session;

    public function __construct(
        UpdatePasswordServiceInterface $restorePasswordService,
        ToastrServiceInterface $toastrService,
        SessionInterface $session,
        FormFactoryInterface $formFactory,
        CsrfTokenManagerInterface $tokenManager
    )
    {
        $this->service = $restorePasswordService;
        $this->toastrService = $toastrService;
        $this->session = $session;
        $this->setFormFactory($formFactory);
        $this->setTokenManager($tokenManager);
    }

    public function access(): array
    {
        return [
            'updatePassword' => [
                SecurityPermissionEnum::UPDATE_PASSWORD_UPDATE,
            ],
        ];
    }

    public function updatePassword(Request $request): Response
    {
        $form = new UpdatePasswordForm();
        $buildForm = $this->buildForm($form, $request);
        if ($buildForm->isSubmitted() && $buildForm->isValid()) {
            try {
                $this->service->update($form);
                $this->toastrService->success(['user.password', 'restore-password.message.create_password_success']);
                return $this->redirectToHome();
            } catch (UnprocessibleEntityException $e) {
                $this->setUnprocessableErrorsToForm($buildForm, $e);
            }
        }

        return $this->render('update-password', [
            'formView' => $buildForm->createView(),
        ]);
    }
}
