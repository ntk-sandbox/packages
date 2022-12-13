<?php

namespace ZnLib\Components\TwigRender\Libs;

use Twig\Environment;
use Twig\Loader\ArrayLoader;
use ZnCore\FileSystem\Helpers\FindFileHelper;

class Render
{

    private $templateList = [];

    public function addTemplateFromContent(string $name, string $content)
    {
        $this->templateList[$name] = $content;
    }

    public function addTemplateFromFile(string $name, string $filePath)
    {
        $this->addTemplateFromContent($name, file_get_contents($filePath));
    }

    public function addTemplatePath(string $directory)
    {
        $files = FindFileHelper::scanDir($directory);
        foreach ($files as $file) {
            $filePath = realpath($directory . '/' . $file);
            $this->addTemplateFromFile($file, $filePath);
//            $this->templateList[$file] = file_get_contents($filePath);
        }
    }

    public function renderFromTemplateContent(string $content, array $variables = []): string
    {
        $hash = hash('sha256', $content);
        $templateName = $hash . '.twig';
        $this->addTemplateFromContent($templateName, $content);
        $loader = new ArrayLoader($this->templateList);
        $twig = new Environment($loader);
        $template = $twig->load($templateName);
        return $template->render($variables);
    }

    public function render(string $template, array $variables = []): string
    {
        $loader = new ArrayLoader($this->templateList);
        /*$loader = new \Twig\Loader\ArrayLoader([
            'template.twig' => file_get_contents(__DIR__ . '/../../../../../src/Certification/Domain/data/printable-document/template.twig'),
            'layout.twig' => file_get_contents(__DIR__ . '/../../../../../src/Certification/Domain/data/printable-document/layout.twig'),
        ]);*/
        //$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../../../../../src/Certification/Domain/data/printable-document');
        $twig = new Environment($loader);
        $template = $twig->load($template);
        return $template->render($variables);
    }
}
