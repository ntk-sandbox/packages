<?php

namespace Untek\User\Registration\Domain\Forms;

use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Untek\Lib\I18Next\Facades\I18Next;
use Untek\Domain\Validator\Interfaces\ValidationByMetadataInterface;
use Untek\Lib\Web\Form\Interfaces\BuildFormInterface;
use Untek\User\Password\Domain\Helpers\PasswordValidatorHelper;

class RegistrationForm implements ValidationByMetadataInterface, BuildFormInterface
{

    private $email;
    private $phone;
    private $password;
    private $passwordConfirm;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('email', new Assert\NotBlank());
        $metadata->addPropertyConstraint('email', new Assert\Email());
        $metadata->addPropertyConstraint('phone', new Assert\NotBlank());

        $metadata->addPropertyConstraint('password', PasswordValidatorHelper::createConstraint());
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
            ->add('phone', TextType::class, [
                'label' => 'phone'
            ])
            ->add('password', PasswordType::class, [
                'label' => 'password'
            ])
            ->add('passwordConfirm', PasswordType::class, [
                'label' => 'passwordConfirm'
            ])
            ->add('save', SubmitType::class, [
                'label' => I18Next::t('core', 'action.send')
            ]);
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = trim($email);
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone): void
    {
        $this->phone = trim($phone);
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password): void
    {
        $this->password = trim($password);
    }

    public function getPasswordConfirm()
    {
        return $this->passwordConfirm;
    }

    public function setPasswordConfirm($passwordConfirm): void
    {
        $this->passwordConfirm = trim($passwordConfirm);
    }
}
