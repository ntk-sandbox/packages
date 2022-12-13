<?php

namespace ZnBundle\Language\Tests\Web;

use Tests\Helpers\FixtureHelper;

class LanguageTest extends \ZnLib\Web\Test\BaseWebTest
{

    protected function fixtures(): array
    {
        return [
            'language',
            'language_bundle',
            'rpc_route',
            'user_identity',
            'user_credential',
            'user_token',
            'rbac_assignment',
            'rbac_inheritance',
            'settings_system',
        ];
    }

    public function testSwitchKzSuccess()
    {
        $this->markTestIncomplete();
        $browser = $this->getBrowserByLogin("admin");
        $this->sendRequest($browser, 'language/current/switch?locale=kz-KK');
        $this->createAssert($browser)
            ->assertContainsContent('Тіл ауыстырылды');
    }

    public function testSwitchRuSuccess()
    {
        $this->markTestIncomplete();
        $browser = $this->getBrowserByLogin("admin");
        $this->sendRequest($browser, 'language/current/switch?locale=ru-RU');
        $this->createAssert($browser)
            ->assertContainsContent('Язык переключен');
    }
}
