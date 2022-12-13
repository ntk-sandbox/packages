<?php

namespace ZnLib\Components\CommonTranslate;

use ZnCore\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'commonTranslate';
    }

    public function i18next(): array
    {
        return [
            'core' => __DIR__ . '/i18next/__lng__/__ns__.json',
        ];
    }
}
