<?php

namespace Untek\Tool\Test\Base;

use Untek\Tool\Test\Asserts\RestWebAssert;
use Psr\Http\Message\ResponseInterface;

abstract class BaseRestWebTest extends BaseRestTest
{

    protected function printHtmlContent(ResponseInterface $response = null) {
        $this->printContent($response, 'strip_tags');
    }

    protected function getRestAssert(ResponseInterface $response = null): RestWebAssert
    {
        return new RestWebAssert($response);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->setBaseUrl(getenv('WEB_URL'));
    }
}