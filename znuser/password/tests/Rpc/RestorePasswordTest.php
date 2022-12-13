<?php

namespace ZnUser\Password\Tests\Rpc\User;

use ZnBundle\Notify\Test\Helpers\EmailHelper;
use ZnFramework\Rpc\Test\BaseRpcTest;

class RestorePasswordTest extends BaseRpcTest
{

    protected function fixtures(): array
    {
        return [
            'rpc_route',
            'user_credential',
            'user_token',
            'rbac_assignment',
            'rbac_inheritance',
            'settings_system',
            'security_password_history',
            'user_confirm',
            'notify_type',
            'notify_type_i18n',
            'notify_type_transport',
            'notify_transport',
        ];
    }

    protected function defaultRpcMethod(): ?string
    {
        return 'restorePassword.createPassword';
    }

    public function testRequestActivationCodeSuccess()
    {
        $request = $this->createRequest();
        $request->setMethod('restorePassword.requestActivationCode');
        $request->setParams([
            "email" => "admin@example.com",
        ]);

        $response = $this->sendRequestByEntity($request);
        $this->getRpcAssert($response)->assertIsResult();
    }

    public function testRequestActivationNotFoundEmail()
    {
        $request = $this->createRequest();
        $request->setMethod('restorePassword.requestActivationCode');
        $request->setParams([
            "email" => "qwerty123@example.com",
        ]);

        $response = $this->sendRequestByEntity($request);

        $expected = [
            [
                "field" => "email",
                "message" => "Не найдено",
            ],
        ];

        $this->getRpcAssert($response)->assertUnprocessableEntityErrors($expected);
    }

    public function testRequestActivationCodeInvalidEmail()
    {
        $request = $this->createRequest();
        $request->setMethod('restorePassword.requestActivationCode');
        $request->setParams([
            "email" => "user123example.com",
        ]);

        $response = $this->sendRequestByEntity($request);

        $expected = [
            [
                "field" => "email",
                "message" => "Значение адреса электронной почты недопустимо.",
            ],
        ];

        $this->getRpcAssert($response)->assertUnprocessableEntityErrors($expected);
    }

    public function testCreatePasswordSuccess()
    {
        // Запрос кода активации
        $request = $this->createRequest();
        $request->setMethod('restorePassword.requestActivationCode');
        $request->setParams([
            "email" => "admin@example.com",
        ]);
        $this->sendRequestByEntity($request);

        // Создание нового пароля
        $request = $this->createRequest();
        //$request->setMethod('restorePassword.createPassword');
        $request->setParams([
            "email" => "admin@example.com",
            "activation_code" => EmailHelper::getLastActivationCode(),
            "password" => "Qwerty123#",
            "password_confirm" => "Qwerty123#",
        ]);
        $response = $this->sendRequestByEntity($request);
        $this->getRpcAssert($response)->assertIsResult();

        // Повторная отправка запроса
        $response = $this->sendRequestByEntity($request);
        $this->getRpcAssert($response)
            ->assertErrorCode(404)->
            assertErrorMessage('Не найден запрос кода активации, выполните первый шаг');

        $this->assertEntity([
            'to' => "admin@example.com",
            'subject' => "Ваш пароль изменен",
            //'body' => "Только что был изменен Ваш пароль. Если это были не вы, то переидите по этой ссылке",
            //'html' => "Только что был изменен Ваш пароль. Если это были не вы, то переидите по этой ссылке",
        ], EmailHelper::oneLast());
    }

    public function testCreatePasswordNotFoundEmail()
    {
        $request = $this->createRequest();
        //$request->setMethod('restorePassword.createPassword');
        $request->setParams([
            "email" => "qwerty123@example.com",
            "activation_code" => "123456",
            "password" => "Qwerty123#",
            "password_confirm" => "Qwerty123#",
        ]);

        $response = $this->sendRequestByEntity($request);

        $expected = [
            [
                "field" => "email",
                "message" => "Не найдено",
            ],
        ];

        $this->getRpcAssert($response)->assertUnprocessableEntityErrors($expected);
    }

    public function testCreatePasswordLightPassword()
    {
        $request = $this->createRequest();
        //$request->setMethod('restorePassword.createPassword');
        $request->setParams([
            "email" => "user123@example.com",
            "activation_code" => "123456",
            "password" => "qwertyuio",
            "password_confirm" => "qwertyuio",
        ]);

        $response = $this->sendRequestByEntity($request);

        $expected = [
            [
                "field" => "password",
                "message" => "Слишком легкий пароль. Пароль должен содержать: латинские буквы нижнего регистра, латинские буквы верхнего регистра, цифры, спецсимволы",
            ],
        ];

        $this->getRpcAssert($response)->assertUnprocessableEntityErrors($expected);
    }

    public function testCreatePasswordShortPassword()
    {
        $request = $this->createRequest();
        //$request->setMethod('restorePassword.createPassword');
        $request->setParams([
            "email" => "admin@example.com",
            "activation_code" => "123456",
            "password" => "Qwe",
            "password_confirm" => "Qwe",
        ]);

        $response = $this->sendRequestByEntity($request);

        $expected = [
            [
                "field" => "password",
                "message" => "Значение слишком короткое. Должно быть равно 6 символам или больше.",
            ],
            [
                "field" => "password",
                "message" => "Слишком легкий пароль. Пароль должен содержать: латинские буквы нижнего регистра, латинские буквы верхнего регистра, цифры, спецсимволы",
            ],
        ];

        $this->getRpcAssert($response)->assertUnprocessableEntityErrors($expected);
    }

    public function testCreatePasswordNotEqualPasswordWithConfirm()
    {
        $request = $this->createRequest();
        //$request->setMethod('restorePassword.createPassword');
        $request->setParams([
            "email" => "user123@example.com",
            "activation_code" => "123456",
            "password" => "Qwerty123#",
            "password_confirm" => "Qwerty121#",
        ]);

        $response = $this->sendRequestByEntity($request);

        $expected = [
            [
                "field" => "passwordConfirm",
                "message" => "Неверный повтор пароля",
            ]
        ];

        $this->getRpcAssert($response)->assertUnprocessableEntityErrors($expected);
    }
}
