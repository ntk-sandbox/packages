<?php

namespace ZnCore\DotEnv\Domain\Libs;

use Symfony\Component\Dotenv\Dotenv;

class DotEnvLoader
{

    public function loadFromFile(string $path): array
    {
        $dotEnv = new Dotenv();
        $content = file_get_contents($path);
        $parsedEnv = $dotEnv->parse($content, $path);
        return $parsedEnv;
    }
}
