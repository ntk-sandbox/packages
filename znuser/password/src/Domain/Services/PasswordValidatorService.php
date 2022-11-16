<?php

namespace ZnUser\Password\Domain\Services;

use ZnUser\Password\Domain\Entities\PasswordValidatorEntity;
use ZnUser\Password\Domain\Interfaces\Services\PasswordBlacklistServiceInterface;
use ZnUser\Password\Domain\Interfaces\Services\PasswordValidatorServiceInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnLib\I18Next\Facades\I18Next;
use ZnDomain\Service\Base\BaseService;
use ZnDomain\Validator\Exceptions\UnprocessibleEntityException;
use ZnDomain\Validator\Helpers\ValidationHelper;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;

class PasswordValidatorService extends BaseService implements PasswordValidatorServiceInterface
{

    private $blacklistService;

    public function __construct(
        EntityManagerInterface $em,
        PasswordBlacklistServiceInterface $blacklistService
    )
    {
        $this->setEntityManager($em);
        $this->blacklistService = $blacklistService;
    }

    private $minLen = 6;
    private $maxLen = 18;
    private $lowerCaseRequired = true;
    private $upperCaseRequired = true;
    private $numericRequired = true;
    private $specialCharRequired = true;

    public function getMinLen(): int
    {
        return $this->minLen;
    }

    public function setMinLen(int $minLen): void
    {
        $this->minLen = $minLen;
    }

    public function getMaxLen(): int
    {
        return $this->maxLen;
    }

    public function setMaxLen(int $maxLen): void
    {
        $this->maxLen = $maxLen;
    }

    public function isLowerCaseRequired(): bool
    {
        return $this->lowerCaseRequired;
    }

    public function setLowerCaseRequired(bool $lowerCaseRequired): void
    {
        $this->lowerCaseRequired = $lowerCaseRequired;
    }

    public function isUpperCaseRequired(): bool
    {
        return $this->upperCaseRequired;
    }

    public function setUpperCaseRequired(bool $upperCaseRequired): void
    {
        $this->upperCaseRequired = $upperCaseRequired;
    }

    public function isNumericRequired(): bool
    {
        return $this->numericRequired;
    }

    public function setNumericRequired(bool $numericRequired): void
    {
        $this->numericRequired = $numericRequired;
    }

    public function isSpecialCharRequired(): bool
    {
        return $this->specialCharRequired;
    }

    public function setSpecialCharRequired(bool $specialCharRequired): void
    {
        $this->specialCharRequired = $specialCharRequired;
    }

    public function isValid(string $password): bool
    {
        try {
            $this->validate($password);
            return true;
        } catch (UnprocessibleEntityException $e) {
            return false;
        }
    }

    public function validateEntity(PasswordValidatorEntity $passwordEntity): void
    {
        $this->prepareValidator();
        ValidationHelper::validateEntity($passwordEntity);

        $this->checkUniqueChars($passwordEntity->getPassword());
        $this->checkBlacklist($passwordEntity->getPassword());
    }

    public function validate(?string $password): void
    {
        $this->prepareValidator();
        $passwordEntity = new PasswordValidatorEntity($password);
        ValidationHelper::validateEntity($passwordEntity);

        $this->checkUniqueChars($password);
        $this->checkBlacklist($password);
    }

    private function checkUniqueChars(string $password): void {
        $charRate = [];
        foreach (str_split(mb_strtolower($password)) as $char) {
            if(isset($charRate[$char])) {
                $charRate[$char]++;
            } else {
                $charRate[$char] = 1;
            }
        }
        $uniqueCount = count($charRate);
        $uniqueRate = $uniqueCount / mb_strlen($password);
        if($uniqueRate < 0.5) {
            $this->showError(I18Next::t('user.password', 'password.message.password_unique_chars'));
        }
    }

    private function showError(string $message): void {
        $exception = new UnprocessibleEntityException;
        $exception->add('password', $message);
        throw $exception;
    }

    private function checkBlacklist(string $password): void {
        $isHas = $this->blacklistService->isHas($password);
        if($isHas) {
            $this->showError(I18Next::t('user.password', 'password.message.password_found_in_blacklist'));
        }
    }

    private function prepareValidator()
    {
        /*PasswordValidatorEntity::clearValidator();
        PasswordValidatorEntity::addValidator(new Assert\NotBlank);
        PasswordValidatorEntity::addValidator(new Assert\Length([
            'min' => $this->minLen,
            'max' => $this->maxLen
        ]));
        PasswordValidatorEntity::addValidator($this->createRegexConstraint());*/

        $callback = function (ClassMetadata $metadata)
        {
            $metadata->addPropertyConstraint('password', new Assert\NotBlank());
            $metadata->addPropertyConstraint('password', new Assert\Length([
                'min' => $this->minLen,
                'max' => $this->maxLen
            ]));
            $metadata->addPropertyConstraint('password', $this->createRegexConstraint());
        };
        PasswordValidatorEntity::setCallback($callback);
    }

    private function createRegexConstraint(): Assert\Regex {
        $requiredMessage = [];
        $expContent = '';
        if ($this->lowerCaseRequired) {
            $expContent .= '(?=.*[a-z])';
            $requiredMessage[] = I18Next::t('user.password', 'password.required.lower');
        }
        if ($this->upperCaseRequired) {
            $expContent .= '(?=.*[A-Z])';
            $requiredMessage[] = I18Next::t('user.password', 'password.required.upper');
        }
        if ($this->numericRequired) {
            $expContent .= '(?=.*\d)';
            $requiredMessage[] = I18Next::t('user.password', 'password.required.numeric');
        }
        if ($this->specialCharRequired) {
            $specCharsExp = preg_quote("[$&+,:;=?@#|'<>.-^*()%!\"'_\\]");
            $expContent .= '(?=.*['.$specCharsExp.']+)';
            $requiredMessage[] = I18Next::t('user.password', 'password.required.special_char');
        }
        $exp = '/^' . $expContent . '.*$/';
        return new Assert\Regex([
            'pattern' => $exp,
            'message' => I18Next::t('user.password', 'password.message.password_must_contain_characters') . implode(', ', $requiredMessage),
        ]);
    }
}
