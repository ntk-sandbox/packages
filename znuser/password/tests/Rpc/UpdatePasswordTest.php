<?php

namespace ZnUser\Password\Tests\Rpc\User;

use Tests\Enums\UserEnum;
use ZnBundle\Notify\Test\Helpers\EmailHelper;
use Tests\Rpc\BaseTest;

class UpdatePasswordTest extends BaseTest
{

    protected function fixtures(): array
    {
        return [
            'security_password_history',
            'notify_type',
            'notify_type_i18n',
            'notify_type_transport',
            'notify_transport',
        ];
    }

    protected function defaultRpcMethod(): ?string
    {
        return 'updatePassword.update';
    }

    public function testSuccess()
    {
        $newPassword = "Qwerty456#";
        $request = $this->createRequest(UserEnum::ADMIN_ID);
        $request->setParams([
            "current_password" => UserEnum::PASSWORD,
            "new_password" => $newPassword,
            "new_password_confirm" => $newPassword,
        ]);
        $response = $this->sendRequestByEntity($request);
        $this->getRpcAssert($response)->assertIsResult();

        $this->assertSuccessAuthorization(UserEnum::ADMIN, $newPassword);

        $this->assertEntity([
            'to' => "admin@example.com",
            'subject' => "Ваш пароль изменен",
//            'body' => "Только что был изменен Ваш пароль. Если это были не вы, то переидите по этой ссылке",
//            'html' => "Только что был изменен Ваш пароль. Если это были не вы, то переидите по этой ссылке",
        ], EmailHelper::oneLast());
    }

    public function testUnauthorized()
    {
        $request = $this->createRequest();
        $response = $this->sendRequestByEntity($request);
        $this->getRpcAssert($response)->assertErrorCode(401);
    }

    public function testRepeatPassword()
    {
        $request = $this->createRequest(UserEnum::ADMIN_ID);
        $request->setParams([
            "current_password" => UserEnum::PASSWORD,
            "new_password" => "Qwerty456#",
            "new_password_confirm" => "Qwerty456#",
        ]);

        $response = $this->sendRequestByEntity($request);
        $this->getRpcAssert($response)->assertIsResult();

        /*$request->setParams([
            "current_password" => "Qwerty456#",
            "new_password" => "Qwerty4567#",
            "new_password_confirm" => "Qwerty4567#",
        ]);

        $response = $this->sendRequestByEntity($request);
        $this->getRpcAssert($response)->assertIsResult();

        $request->setParams([
            "current_password" => UserEnum::PASSWORD,
            "new_password" => "Qwerty456#",
            "new_password_confirm" => "Qwerty456#",
        ]);

        $response = $this->sendRequestByEntity($request);

        $expected = [
            [
                "field" => "currentPassword",
                "message" => "Неверный текущий пароль",
            ],
        ];

        $this->getRpcAssert($response)->assertUnprocessableEntityErrors($expected);*/
    }

    public function testLightPassword()
    {
        $request = $this->createRequest(UserEnum::ADMIN_ID);
        $request->setParams([
            "current_password" => UserEnum::PASSWORD,
            "new_password" => "qwertyuio",
            "new_password_confirm" => "qwertyuio",
        ]);

        $response = $this->sendRequestByEntity($request);

        $expected = [
            [
                "field" => "newPassword",
                "message" => "Слишком легкий пароль. Пароль должен содержать: латинские буквы нижнего регистра, латинские буквы верхнего регистра, цифры, спецсимволы",
            ],
        ];

        $this->getRpcAssert($response)->assertUnprocessableEntityErrors($expected);
    }

    public function testCreatePasswordShortPassword()
    {
        $request = $this->createRequest(UserEnum::ADMIN_ID);
        $request->setParams([
            "current_password" => UserEnum::PASSWORD,
            "new_password" => "Qwe",
            "new_password_confirm" => "Qwe",
        ]);

        $response = $this->sendRequestByEntity($request);

        $expected = [
            [
                "field" => "newPassword",
                "message" => "Значение слишком короткое. Должно быть равно 6 символам или больше.",
            ],
            [
                "field" => "newPassword",
                "message" => "Слишком легкий пароль. Пароль должен содержать: латинские буквы нижнего регистра, латинские буквы верхнего регистра, цифры, спецсимволы",
            ],
        ];

        $this->getRpcAssert($response)->assertUnprocessableEntityErrors($expected);
    }

    public function testCreatePasswordNotEqualPasswordWithConfirm()
    {
        $request = $this->createRequest(UserEnum::ADMIN_ID);
        $request->setParams([
            "current_password" => UserEnum::PASSWORD,
            "new_password" => "Qwerty456#",
            "new_password_confirm" => "Qwerty457#",
        ]);

        $response = $this->sendRequestByEntity($request);

        $expected = [
            [
                "field" => "newPasswordConfirm",
                "message" => "Неверный повтор пароля",
            ]
        ];

        $this->getRpcAssert($response)->assertUnprocessableEntityErrors($expected);
    }

    public function testCurrentPasswordEqualNewPasswordWithConfirm()
    {
        $request = $this->createRequest(UserEnum::ADMIN_ID);
        $request->setParams([
            "current_password" => UserEnum::PASSWORD,
            "new_password" => UserEnum::PASSWORD,
            "new_password_confirm" => UserEnum::PASSWORD,
        ]);

        $response = $this->sendRequestByEntity($request);

        $expected = [
            [
                "field" => "newPassword",
                "message" => "Слишком легкий пароль. Пароль должен содержать: латинские буквы нижнего регистра, латинские буквы верхнего регистра, цифры, спецсимволы",
            ],
            [
                "field" => "newPassword",
                "message" => "Текущий пароль не должен совпадать с новым.",
            ]
        ];

        $this->getRpcAssert($response)->assertUnprocessableEntityErrors($expected);
    }
}
