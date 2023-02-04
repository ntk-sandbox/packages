<?php

namespace Untek\User\Authentication\Tests\Web;

use Untek\Lib\Web\Test\BaseWebTest;

class UserAuthTest extends BaseWebTest
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
        ];
    }

    public function testPage()
    {
        $browser = $this->getBrowser();
        $this->sendRequest($browser, 'auth');
        $this->createAssert($browser)
            ->assertContainsContent('Логин')
            ->assertContainsContent('Пароль');
    }

    public function testLoginSuccess()
    {
        $browser = $this->getBrowser();
        $this->sendForm($browser, 'auth', 'Вход', [
            'form[login]' => 'admin',
            'form[password]' => 'Wwwqqq111',
        ]);
        $this->createAssert($browser)
            ->assertContainsContent('Вы успешно зашли в систему!');
    }

    public function testLoginBadPassword()
    {
        $browser = $this->getBrowser();
        $this->sendForm($browser, 'auth', 'Вход', [
            'form[login]' => 'admin',
            'form[password]' => 'Wwwqqq222',
        ]);
        $this->createAssert($browser)
            ->assertContainsContent('Неверный пароль');
    }

    public function testLoginAlready()
    {
        $browser = $this->getBrowserByLogin("admin");
        $this->sendRequest($browser, 'auth');
        $this->createAssert($browser)
            ->assertContainsContent('Вы уже авторизованы!');
    }
}
