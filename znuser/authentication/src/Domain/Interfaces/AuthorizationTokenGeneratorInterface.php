<?php

namespace ZnUser\Authentication\Domain\Interfaces;

/**
 * Generates authorization tokens.
 */
interface AuthorizationTokenGeneratorInterface
{
    /**
     * Generates a authorization token.
     *
     * @return string
     */
    public function generateToken(): string;
}
