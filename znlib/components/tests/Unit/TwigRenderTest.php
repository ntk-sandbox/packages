<?php

namespace Untek\Lib\Components\Tests\Unit;

use Untek\Core\FileSystem\Helpers\FileStorageHelper;
use Untek\Lib\Components\TwigRender\Libs\Render;
use Untek\Tool\Test\Asserts\DataAssert;
use Untek\Tool\Test\Asserts\DataTestCase;

final class TwigRenderTest extends DataTestCase
{

    public function testAll()
    {
        $render = new Render();
        $render->addTemplatePath(__DIR__ . '/../fixture/TwigRender/template');
        $templateVars = [
            'header' => 'header value',
            'contentVar' => 'content value',
            'footer' => 'footer value',
        ];
        $templateCode = '{{contentVar}}';
        $twigTemplate = '
{% extends "template.html.twig" %}
{% block contentHtml %}
    ' . $templateCode . '
{% endblock %}
        ';

        $html = $render->renderFromTemplateContent($twigTemplate, $templateVars);
        $resultFileName = __DIR__ . '/../fixture/TwigRender/result/rendered.html';
        $expected = FileStorageHelper::load($resultFileName);

//        FileStorageHelper::save($resultFileName, $html);
//        dd($expected, $html);
        $this->assertEquals($expected, $html);
    }

    public function testEmpty()
    {
        $render = new Render();
        $render->addTemplatePath(__DIR__ . '/../fixture/TwigRender/template');
        $templateVars = [
//            'header' => 'header value',
            'contentVar' => 'content value',
//            'footer' => 'footer value',
        ];
        $templateCode = '{{contentVar}}';
        $twigTemplate = '
{% extends "template.html.twig" %}
{% block contentHtml %}
    ' . $templateCode . '
{% endblock %}
        ';

        $html = $render->renderFromTemplateContent($twigTemplate, $templateVars);
        $resultFileName = __DIR__ . '/../fixture/TwigRender/result/renderedEmpty.html';
        $expected = FileStorageHelper::load($resultFileName);
//        FileStorageHelper::save($resultFileName, $html);
//        dd($html);
        $this->assertEquals($expected, $html);
    }
}
