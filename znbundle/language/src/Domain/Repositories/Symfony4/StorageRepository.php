<?php

namespace Untek\Bundle\Language\Domain\Repositories\Symfony4;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Untek\Bundle\Language\Domain\Interfaces\Repositories\StorageRepositoryInterface;

class StorageRepository implements StorageRepositoryInterface
{

    const COOKIE_KEY = 'language';

    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function setLanguage(string $locale)
    {
        $this->session->set(self::COOKIE_KEY, $locale);
    }

    public function getLanguage(): string
    {
        return $this->session->get(self::COOKIE_KEY, 'ru');
    }
}
