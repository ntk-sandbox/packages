<?php

namespace Untek\User\Password\Domain\Forms;

use Untek\User\Password\Domain\Helpers\PasswordValidatorHelper;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Untek\Lib\I18Next\Facades\I18Next;
use Untek\Model\Validator\Interfaces\ValidationByMetadataInterface;
use Untek\Lib\Web\Form\Interfaces\BuildFormInterface;

class CreatePasswordForm implements ValidationByMetadataInterface, BuildFormInterface
{

    private $email;
    private $activationCode;
    private $password;
    private $passwordConfirm;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('email', new Assert\NotBlank());
        $metadata->addPropertyConstraint('email', new Assert\Email());

        $metadata->addPropertyConstraint('activationCode', new Assert\NotBlank);

        $metadata->addPropertyConstraint('password', PasswordValidatorHelper::createConstraint());

        /*$metadata->addPropertyConstraint('password', new Assert\NotBlank);
        $metadata->addPropertyConstraint('password', new Assert\Length(['min' => 6, 'max' => 18]));
        $metadata->addPropertyConstraint('password', new Assert\Regex([
            'pattern' => '/' . RegexpPatternEnum::PASSWORD_REQUIRED . '/',
            'message' => I18Next::t('user', 'password.the_password_is_too_light'),
        ]));*/


        $metadata->addPropertyConstraint('passwordConfirm', new Assert\NotBlank);
        $metadata->addPropertyConstraint('passwordConfirm', new Assert\EqualTo([
            'propertyPath' => 'password',
            'message' => I18Next::t('user.password', 'change-password.message.does_not_match_the_new_password'),
        ]));
    }

    public function buildForm(FormBuilderInterface $formBuilder)
    {
        $formBuilder
            ->add('email', TextType::class, [
                'label' => 'Email'
            ])
            ->add('activationCode', TextType::class, [
                'label' => I18Next::t('user.password', 'restore-password.attribute.activationCode')
            ])
            ->add('password', PasswordType::class, [
                'label' => I18Next::t('user.password', 'restore-password.attribute.password')
            ])
            ->add('passwordConfirm', PasswordType::class, [
                'label' => I18Next::t('user.password', 'restore-password.attribute.passwordConfirm')
            ])
            ->add('save', SubmitType::class, [
                'label' => I18Next::t('core', 'action.send')
            ]);
    }

    public function getActivationCode(): string
    {
        return $this->activationCode;
    }

    public function setActivationCode(string $activationCode): void
    {
        $this->activationCode = $activationCode;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = trim($password);
    }

    public function getPasswordConfirm(): string
    {
        return $this->passwordConfirm;
    }

    public function setPasswordConfirm(string $passwordConfirm): void
    {
        $this->passwordConfirm = trim($passwordConfirm);
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = trim($email);
    }
}
