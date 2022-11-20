<?php

namespace ZnBundle\Language\Tests\Web;

use Tests\Enums\UserEnum;
use Tests\Helpers\FixtureHelper;

class LanguageTest extends \ZnLib\Web\Test\BaseWebTest
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

    public function testSwitchKzSuccess()
    {
        $browser = $this->getBrowserByLogin(UserEnum::ADMIN);
        $this->sendRequest($browser, 'language/current/switch?locale=kz-KK');
        $this->createAssert($browser)
            ->assertContainsContent('Тіл ауыстырылды');
    }

    public function testSwitchRuSuccess()
    {
        $browser = $this->getBrowserByLogin(UserEnum::ADMIN);
        $this->sendRequest($browser, 'language/current/switch?locale=ru-RU');
        $this->createAssert($browser)
            ->assertContainsContent('Язык переключен');
    }
}
