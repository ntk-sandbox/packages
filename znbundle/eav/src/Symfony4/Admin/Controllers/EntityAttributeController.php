<?php

namespace ZnBundle\Eav\Symfony4\Admin\Controllers;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use ZnBundle\Eav\Domain\Entities\EntityAttributeEntity;
use ZnBundle\Eav\Domain\Interfaces\Services\EntityAttributeServiceInterface;
use ZnBundle\Notify\Domain\Interfaces\Services\ToastrServiceInterface;
use ZnCore\Code\Helpers\PropertyHelper;
use ZnDomain\Entity\Helpers\EntityHelper;
use ZnDomain\Validator\Exceptions\UnprocessibleEntityException;
use ZnLib\Web\Controller\Base\BaseWebCrudController;
use ZnLib\Web\Controller\Interfaces\ControllerAccessInterface;
use ZnLib\Web\Form\Interfaces\BuildFormInterface;
use ZnLib\Web\Html\Helpers\Url;
use ZnLib\Web\TwBootstrap\Widgets\Breadcrumb\BreadcrumbWidget;

class EntityAttributeController extends BaseWebCrudController implements ControllerAccessInterface
{

    protected $viewsDir = __DIR__ . '/../views/entity-attribute';
    protected $baseUri = '/eav/entity-attribute';

    public function __construct(
        ToastrServiceInterface $toastrService,
        FormFactoryInterface $formFactory,
        CsrfTokenManagerInterface $tokenManager,
        BreadcrumbWidget $breadcrumbWidget,
        EntityAttributeServiceInterface $service
    )
    {
        $this->setService($service);
        $this->setToastrService($toastrService);
        $this->setFormFactory($formFactory);
        $this->setTokenManager($tokenManager);
        $this->setBreadcrumbWidget($breadcrumbWidget);

        $title = 'EAV entity attribute';
        $this->getBreadcrumbWidget()->add($title, Url::to([$this->getBaseUri()]));
    }

    public function update(Request $request): Response
    {
        $id = $request->query->get('id');
        /** @var BuildFormInterface | EntityAttributeEntity $form */
        $form = $this->getService()->findOneById($id);
        $this->getBreadcrumbWidget()->add('update', Url::to([$this->getBaseUri() . '/update', 'id' => $id]));
        $title = PropertyHelper::getValue($form, $this->titleAttribute());
        $this->getView()->addAttribute('title', $title);
        $buildForm = $this->buildForm($form, $request);
        if ($buildForm->isSubmitted() && $buildForm->isValid()) {
            try {
                $this->getService()->updateById($id, EntityHelper::toArray($form));
                $this->getToastrService()->success(['core', 'message.saved_success']);
                //dd();
                return $this->redirect(Url::to(['/eav/entity/view', 'id' => $form->getEntityId()]));
            } catch (UnprocessibleEntityException $e) {
                $this->setUnprocessableErrorsToForm($buildForm, $e);
            }
        }
        return $this->render('form', [
            'formView' => $buildForm->createView(),
            'baseUri' => $this->getBaseUri(),
        ]);
    }
}
