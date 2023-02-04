<?php

namespace Untek\User\Password\Tests\Unit;

use Untek\Lib\I18Next\Facades\I18Next;
use Untek\Domain\Validator\Helpers\ErrorCollectionHelper;
use Untek\User\Password\Domain\Interfaces\Services\PasswordValidatorServiceInterface;
use Untek\Core\Instance\Helpers\ClassHelper;
use Untek\Domain\Validator\Exceptions\UnprocessibleEntityException;
use Untek\Domain\Validator\Helpers\ValidationHelper;
use Untek\Tool\Test\Base\BaseTest;

include_once __DIR__ . '/../bootstrap.php';

final class PasswordValidatorServiceTest extends BaseTest
{

    protected function fixtures(): array
    {
        return [
            'security_password_blacklist',
        ];
    }

    public function testIsValidSuccess()
    {
        $passwordValidatorService = $this->getPasswordValidatorService();
        $isValid = $passwordValidatorService->isValid('Qwer1#');
        $this->assertTrue($isValid);
    }

    public function testLength()
    {
        $expected = [
            "Значение не должно быть пустым.",
            "Значение слишком короткое. Должно быть равно 6 символам или больше.",
        ];
        $this->validate('', $expected);

        $expected = [
            "Значение слишком длинное. Должно быть равно 18 символам или меньше.",
        ];
        $this->validate('Wwwqqq1_0vvxgNZn1Ipck7IV5BTh48vZDwJropQH', $expected);

        $expected = [
            "Значение слишком короткое. Должно быть равно 6 символам или больше.",
        ];
        $this->validate('Qw1#', $expected);
    }

    public function testLengthConfig()
    {
        $passwordValidatorService = $this->getPasswordValidatorService();
        $passwordValidatorService->setMinLen(8);
        $passwordValidatorService->setMaxLen(12);

        $isValid = $passwordValidatorService->isValid('Qwerty1#');
        $this->assertTrue($isValid);

        $isValid = $passwordValidatorService->isValid('Qwert1#'); // короткий
        $this->assertFalse($isValid);

        $isValid = $passwordValidatorService->isValid('Qwertyuiop[]1#'); // длинный
        $this->assertFalse($isValid);
    }

    public function testWithoutSpecChars()
    {
        $passwordValidatorService = $this->getPasswordValidatorService();
        $passwordValidatorService->setSpecialCharRequired(false);

        $isValid = $passwordValidatorService->isValid('Qwerty1');
        $this->assertTrue($isValid);

        $isValid = $passwordValidatorService->isValid('Qwert1');
        $this->assertTrue($isValid);

        $isValid = $passwordValidatorService->isValid('Qwertyuiop1');
        $this->assertTrue($isValid);

        $isValid = $passwordValidatorService->isValid('Qwertyuiop#');
        $this->assertFalse($isValid);

        $isValid = $passwordValidatorService->isValid('#wertyuiop1');
        $this->assertFalse($isValid);

        $expected = [
            "Слишком легкий пароль. Пароль должен содержать: латинские буквы нижнего регистра, латинские буквы верхнего регистра, цифры",
        ];
        $this->validate('qwerty', $expected, $passwordValidatorService);
    }

    public function testRepeatChars()
    {
        $passwordValidatorService = $this->getPasswordValidatorService();

        $expected = [
            "Много повторяющихся символов",
        ];
        $this->validate('Wwwqqq111%', $expected, $passwordValidatorService);
        $this->validate('Wwwwwqqqqqqq111%', $expected, $passwordValidatorService);
        $this->validate('WQ1qw1qw11qwWq1%', $expected, $passwordValidatorService);
        $this->validate('WQ%1qw%1qw1q%Wq1%', $expected, $passwordValidatorService);
    }

    public function testIsValid()
    {
        $this->isValid('Qwer1#', true);
        $this->isValid('Qwerty1#', true);
        $this->isValid('0vvxgNZn1Ipck@', true);
        $this->isValid('u2nd-K2q1j1O_ksW', true);
        $this->isValid('Qwertyuiop[]1#', true);
    }

    public function testIsNotValid()
    {
        $this->isValid('', false); // пустой
        $this->isValid('Qw1#', false); // короткий
        $this->isValid('alalGphqo_Ye-SvYbHhwJ_9FH0kXs6Ak', false); // длинный
    }

    public function testBlacklist()
    {
        $this->isValid('Qwerty16#', false); // пароль в черном списке
        $this->isValid('Qwerty17#', false); // пароль в черном списке
        $this->isValid('Qwerty19#', true);
        $this->isValid('Qwerty15#', true);

        $expected = [
            "Этот пароль находится в черном списке",
        ];
        $this->validate('Qwerty16#', $expected);
    }

    public function testValidateCharSet()
    {
        $expected = [
            "Слишком легкий пароль. Пароль должен содержать: латинские буквы нижнего регистра, латинские буквы верхнего регистра, цифры, спецсимволы",
        ];
        $this->validate('qwerty', $expected);

        $this->isValid('Ww1', false); // короткий, нехватает спецсимволов
        $this->isValid('qwerty#$%', false); // нехватает цифр
        $this->isValid('qwerty1#$%', false); // нехватает больших букв
        $this->isValid('QWERTY1#$%', false); // нехватает маленьких букв
    }

    private function isValid(string $password, bool $expected)
    {
        $passwordValidatorService = $this->getPasswordValidatorService();
        $isValid = $passwordValidatorService->isValid($password);
        $this->assertEquals($expected, $isValid);
    }

    private function validate(string $password, array $expectedMessages, PasswordValidatorServiceInterface $passwordValidatorService = null)
    {
        $expected = [];
        foreach ($expectedMessages as $message) {
            $expected[] = [
                "field" => "password",
                "message" => $message,
            ];
        }
        $passwordValidatorService = $passwordValidatorService ?: $this->getPasswordValidatorService();
        try {
            $passwordValidatorService->validate($password);
            $this->assertFalse(true);
        } catch (UnprocessibleEntityException $exception) {
            $errorData = ErrorCollectionHelper::collectionToArray($exception->getErrorCollection());
            $this->assertEquals($expected, $errorData);
        }
    }

    private function getPasswordValidatorService(): PasswordValidatorServiceInterface
    {
        $passwordValidatorService = ClassHelper::createInstance(PasswordValidatorServiceInterface::class);
        $passwordValidatorService->setMinLen(6);
        $passwordValidatorService->setMaxLen(18);
        $passwordValidatorService->setSpecialCharRequired(true);
        return $passwordValidatorService;
    }
}
