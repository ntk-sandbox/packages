<?php

namespace Tests\Web;

abstract class PersonTest extends \Untek\Lib\Web\Test\BaseWebTest
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
            'eav_attribute',
            'eav_category',
            'eav_entity',
            'eav_entity_attribute',
            'eav_enum',
            'eav_measure',
            'eav_validation',
            'eav_value',
        ];
    }

    public function getUri(): string
    {
        return 'person-settings?entity=personContact';
    }

    public function testListUnauthorized()
    {
        $this->assertUnauthorized($this->getUri());
    }

    public function testInvalidEmail()
    {
        $browser = $this->getBrowserByLogin("admin");
        $this->sendForm($browser, $this->getUri(), 'Сохранить', [
            'form[email]' => 'qwertyexample.com',
        ]);
        $this->createAssert($browser)
            ->assertContainsContent('Значение адреса электронной почты недопустимо.');
    }

    public function testSaveEmail()
    {
        $browser = $this->getBrowserByLogin("admin");
        $this->sendForm($browser, $this->getUri(), 'Сохранить', [
            'form[email]' => 'qwerty@example.com',
        ]);
        $this->createAssert($browser)
            ->assertIsNotFormError();
    }

    public function testSuccess()
    {
        $browser = $this->getBrowserByLogin("admin");
        $this->sendRequest($browser, $this->getUri());
        $this->createAssert($browser)
            ->assertIsNotFormError()
            ->assertFormValues('Сохранить', [
                "form[email]" => "qwerty@example.com",
                "form[home]" => "45566",
                "form[mobile]" => "+77771112233",
                "form[work]" => "+77774445566",
            ]);
    }
}
