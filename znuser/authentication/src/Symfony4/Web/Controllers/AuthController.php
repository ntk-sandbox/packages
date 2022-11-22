<?php

namespace ZnUser\Authentication\Symfony4\Web\Controllers;

use DateTime;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use ZnBundle\Notify\Domain\Interfaces\Services\ToastrServiceInterface;
use ZnBundle\Summary\Domain\Exceptions\AttemptsBlockedException;
use ZnBundle\Summary\Domain\Exceptions\AttemptsExhaustedException;
use ZnCore\Contract\User\Exceptions\UnauthorizedException;
use ZnDomain\Validator\Exceptions\UnprocessibleEntityException;
use ZnLib\Components\Http\Enums\HttpStatusCodeEnum;
use ZnLib\Web\Controller\Base\BaseWebController;
use ZnLib\Web\Controller\Interfaces\ControllerAccessInterface;
use ZnLib\Web\Form\Traits\ControllerFormTrait;
use ZnLib\Web\SignedCookie\Libs\CookieValue;
use ZnUser\Authentication\Domain\Enums\Rbac\AuthenticationPermissionEnum;
use ZnUser\Authentication\Domain\Enums\WebCookieEnum;
use ZnUser\Authentication\Domain\Forms\AuthForm;
use ZnUser\Authentication\Domain\Interfaces\Services\AuthServiceInterface;
use ZnUser\Authentication\Symfony4\Web\Enums\WebUserEnum;

class AuthController extends BaseWebController implements ControllerAccessInterface
{

    use ControllerFormTrait;

    protected $viewsDir = __DIR__ . '/../views/auth';
    protected $authService;
    protected $toastrService;
    protected $session;
    private $urlGenerator;

    public function __construct(
        FormFactoryInterface $formFactory,
        CsrfTokenManagerInterface $tokenManager,
        ToastrServiceInterface $toastrService,
        AuthServiceInterface $authService,
        SessionInterface $session,
        UrlGeneratorInterface $urlGenerator,
        private Security $security
    )
    {
        $this->setFormFactory($formFactory);
        $this->setTokenManager($tokenManager);
        $this->authService = $authService;
        $this->toastrService = $toastrService;
        $this->session = $session;
        $this->urlGenerator = $urlGenerator;
    }

    public function access(): array
    {
        return [
            'auth' => [
                AuthenticationPermissionEnum::AUTHENTICATION_WEB_LOGIN,
            ],
            'logout' => [
                AuthenticationPermissionEnum::AUTHENTICATION_WEB_LOGOUT,
            ],
        ];
    }

    public function auth(Request $request): Response
    {
        $identityEntity = $this->security->getUser();
        if ($identityEntity) {
            $this->toastrService->success('Вы уже авторизованы!');
            return $this->redirectToHome();
        }
        $form = new AuthForm();
        $buildForm = $this->buildForm($form, $request);
        $authUrl = $this->urlGenerator->generate('user/auth');
        if ($buildForm->isSubmitted() && $buildForm->isValid()) {
            try {
                $this->authService->authByForm($form);

                $identityEntity = $this->security->getUser();
                if($identityEntity == null) {
                    throw new UnauthorizedException();
                }

                $response = new RedirectResponse('/', HttpStatusCodeEnum::MOVED_TEMPORARILY);

                if($form->getRememberMe()) {
                    $cookieValue = new CookieValue($_ENV['CSRF_TOKEN_ID']);
                    $hashedValue = $cookieValue->encode($identityEntity->getId());
                    $cookie = new Cookie(WebCookieEnum::IDENTITY_ID, $hashedValue, new DateTime('+ 3650 day'));
                    $response->headers->setCookie($cookie);
                }

                $this->toastrService->success(['authentication', 'auth.login_success']);
                $prevUrl = $this->session->get(WebUserEnum::UNAUTHORIZED_URL_SESSION_KEY);
                if (empty($prevUrl) || $prevUrl == $authUrl) {
                    $response->setTargetUrl('/');
                    return $response;
                }
                $this->session->remove(WebUserEnum::UNAUTHORIZED_URL_SESSION_KEY);
                $response->setTargetUrl($prevUrl);
                return $response;
            } catch (UnprocessibleEntityException $e) {
                $this->setUnprocessableErrorsToForm($buildForm, $e);
            } catch (AttemptsBlockedException | AttemptsExhaustedException $e) {
                $buildForm->addError(new FormError($e->getMessage()));
            }
        }

        return $this->render('index', [
            'formView' => $buildForm->createView(),
        ]);
    }

    public function logout(Request $request): Response
    {
        $this->authService->logout();
        $this->toastrService->success(['authentication', 'auth.logout_success']);
        $response = new RedirectResponse('/', HttpStatusCodeEnum::MOVED_TEMPORARILY);
        $response->headers->clearCookie(WebCookieEnum::IDENTITY_ID);
        return $response;
    }
}
