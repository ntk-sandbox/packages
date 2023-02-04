<?php

namespace Untek\Sandbox\Sandbox\WebTest\Domain\Libs\Plugins;

use Untek\Sandbox\Sandbox\WebTest\Domain\Traits\PluginParentTrait;

class JsonAuthPlugin
{

    use PluginParentTrait;

    public string $headerName = 'Authorization';

    /**
     * Add an authorization token for the request.
     *
     * @param  string  $token
     * @param  string  $type
     * @return $this
     */
    public function withToken(string $token, string $type = 'Bearer')
    {
        return $this->client->withHeader($this->headerName, $type.' '.$token);
    }

    /**
     * Remove the authorization token from the request.
     *
     * @return $this
     */
    public function withoutToken()
    {
        $this->client->removeHeader($this->headerName);

        return $this;
    }
}
