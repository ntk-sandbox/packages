<?php

namespace Untek\Lib\Components\SymfonyTranslation\Libs;

use Psr\Log\LoggerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Untek\Core\Env\Helpers\EnvHelper;
use Untek\Lib\I18Next\Exceptions\NotFoundBundleException;
use Untek\Lib\I18Next\Facades\I18Next;
use Untek\Lib\Components\SymfonyTranslation\Helpers\TranslatorHelper;
use Untek\Model\Entity\Helpers\EntityHelper;

class Translator implements TranslatorInterface
{

    private $bundleName;
    private $domain;
    private $logger;
    private $locale;

    public function __construct(string $locale, string $bundleName, string $domain = 'validators', LoggerInterface $logger = null)
    {
        $this->bundleName = $bundleName;
        $this->domain = $domain;
        $this->logger = $logger;
        $this->locale = $locale;
    }

    public function trans(string $id, array $parameters = [], string $domain = null, string $locale = null): string
    {
        $domain = $domain ?: $this->domain;
        $parametersI18Next = TranslatorHelper::paramsToI18Next($parameters);
        $key = $domain . '.' . TranslatorHelper::messageToHash($id);
        $translatedMessage = $this->translateMessage($key, $parametersI18Next);
        if($translatedMessage == null) {
            return strtr($id, $parameters);
        }
        $translatedMessageSplitted = explode('|', $translatedMessage);
        if(count($translatedMessageSplitted) > 1) {
            $translatedMessage = $this->plural_form($parameters['%count%'], $translatedMessageSplitted);
        }
        return $translatedMessage;
    }

    private function plural_form($number, $after) {
        $locale = strtolower($this->locale);
        if(strpos($locale, 'ru') !== false ) {
            $cases = array (2, 0, 1, 1, 1, 2);
            $form = ($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)];
        } else {
            $form = $number == 1 ? 0 : 1;
        }
        return $after[$form];
    }

    private function translateMessage(string $key, array $parameters = []): ?string
    {
        try {
            $translatedMessage = I18Next::t($this->bundleName, $key, $parameters);
            if ($translatedMessage != $key || EnvHelper::isProd()) {
                return $translatedMessage;
            }

            return null;
        } catch (NotFoundBundleException $e) {
            return null;
        }
    }

    public function getLocale(): string
    {
        return $this->locale;
    }
}
