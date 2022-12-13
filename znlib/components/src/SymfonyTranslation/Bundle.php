<?php

namespace ZnLib\Components\SymfonyTranslation;

use ZnCore\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'symfonyTranslation';
    }

    public function i18next(): array
    {
        return [
            'symfony' => __DIR__ . '/i18next/__lng__/__ns__.json',
        ];
    }

    public function container(): array
    {
        return [
            __DIR__ . '/config/container.php',
        ];
    }
}
