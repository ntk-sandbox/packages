<?php

namespace ZnSymfony\Sandbox\Symfony4\Web\Base;

use Symfony\Component\HttpFoundation\Response;
use ZnLib\Components\Format\Encoders\XmlEncoder;
use ZnCore\Arr\Helpers\ArrayHelper;
use ZnDomain\Entity\Helpers\EntityHelper;
use ZnLib\Web\Controller\Base\BaseWebController;
use ZnLib\Web\TwBootstrap\Widgets\TabContent\TabContentWidget;
use ZnLib\Web\TwBootstrap\Widgets\Table\TableWidget;

abstract class BaseController extends BaseWebController
{

//    protected $layout = __DIR__ . '/../views/layouts/main.php';
    protected $viewsDir = __DIR__ . '/../views/common';
    protected $contentArray = [];
    protected $tabs = [];
    protected $dumps = [];
    protected $tabName = 'main';

    protected function renderDefault(array $params = [])
    {
        $viewFile = realpath(__DIR__ . '/../views/common/index.php');
        $params['dumps'] = $this->dumps;
        return $this->renderFile($viewFile, $params);
    }

    protected function toTab(string $tabName, bool $encode = true)
    {
        $this->tabName = $tabName;
    }

    protected function print(string $data)
    {
        $this->contentArray[$this->tabName][] = $data;
    }

    protected function dd($data)
    {
        $this->dumps[] = $data;
    }

    protected function assertEqual($expected, $actual)
    {
        if ($expected == $actual) {
            $this->alertSuccess('is equal!');
        } else {
            /*$message = $this->encodeJson([
                'expected' => $expected,
                'actual' => $actual,
            ]);*/
            $message = 'is not equal!
                <br/>
                expected:<br/><pre>' . $this->encodeJson($expected) . '</pre>
                actual:<br/><pre>' . $this->encodeJson($actual) . '</pre>';
            $this->alertDanger($message);
        }
    }

    protected function printBool(bool $value)
    {
        $this->alertInfo($value ? 'True' : 'False');
    }

    protected function printTable(array $value, array $headers = [])
    {
        if(!ArrayHelper::isIndexed($value)) {
            $rr = [];
            foreach ($value as $name => $value) {
                $rr[] = [$name, $value];
            }
            $value = $rr;
        }
        $html = TableWidget::widget([
            'tableClass' => 'table table-bordered table-striped table-condensed table-sm',
            'body' => $value,
            'header' => $headers,
        ]);
        $this->print($html);
    }

    protected function printSubmit()
    {
        $this->print('<p>
<form name="form" method="POST">
<div class="form-group">
    <button type="submit" id="form_save" class="btn btn-primary" name="form[save]">Отправить</button></div>

</form>
</p>');
    }

    protected function printForm()
    {
        $this->print();
    }

    protected function printHeader(string $message, int $level = 3)
    {
        $message = htmlspecialchars($message);
        $message = "<h$level>" . $message . "</h$level>";
        $this->print($message);
    }

    protected function printCode(string $message)
    {
        $message = htmlspecialchars($message);
        $message = '<pre>' . $message . '</pre>';
        $this->alertInfo($message);
    }

    protected function printPrettyXml($data)
    {
        $xmlEncoder = new XmlEncoder(true, 'UTF-8', false);
        if (!is_array($data)) {
            $data = $xmlEncoder->decode($data);
        }
        $this->printCode($xmlEncoder->encode($data));
    }

    protected function startBuffer() {
        ob_start();
        ob_implicit_flush(false);
    }

    protected function endBuffer() {
        ob_get_clean();
    }

    protected function encodeJson($data)
    {
        $message = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return $message;
    }

    protected function printObject(object $object)
    {
        $message = $this->encodeJson(EntityHelper::toArray($object, true));
        $className = get_class($object);
        $message =
            '<pre>' .
            PHP_EOL .
            '<span class="float-left">' .
            $message .
            '</span>' .
            '<small class="float-right">' .
            $className .
            '</small>' .
            '</pre>';
        $this->alertInfo($message);
    }

    protected function dump($data)
    {
        $message = $this->encodeJson($data);
        $message = '<pre>' . $message . '</pre>';
        $this->alertInfo($message);
    }

    protected function printArray(array $data)
    {
        $message = $this->encodeJson($data);
        $message = '<pre>' . $message . '</pre>';
        $this->alertInfo($message);
    }

    /*protected function error(string $message, string $type = 'danger')
    {
        $alertContent = $this->alertToString($message, $type);
        $this->contentArray[$this->tabName][] = $alertContent;
    }

    protected function alert(string $message, string $type = 'success')
    {
        $alertContent = $this->alertToString($message, $type);
        $this->contentArray[$this->tabName][] = $alertContent;
    }*/

    protected function alertSuccess(string $message)
    {
        $alertContent = $this->alertToString($message, 'success');
        $this->contentArray[$this->tabName][] = $alertContent;
    }

    protected function alertWarning(string $message)
    {
        $alertContent = $this->alertToString($message, 'warning');
        $this->contentArray[$this->tabName][] = $alertContent;
    }

    protected function alertDanger(string $message)
    {
        $alertContent = $this->alertToString($message, 'danger');
        $this->contentArray[$this->tabName][] = $alertContent;
    }

    protected function alertInfo(string $message)
    {
        $alertContent = $this->alertToString($message, 'info');
        $this->contentArray[$this->tabName][] = $alertContent;
    }

    protected function render(string $file, array $params = []): Response
    {
        $content = $this->generateContent();
        $params['content'] = $content . ($params['content'] ?? '');
        return parent::render($file, $params);
    }

    protected function renderFile(string $file, array $params = []): Response
    {
        $content = $this->generateContent();
        $params['content'] = $content . ($params['content'] ?? '');
        return parent::renderFile($file, $params);
    }

    protected function generateContent()
    {
        $content = '';
        if ($this->contentArray) {
            if (count($this->contentArray) > 1) {
                $items = [];
                foreach ($this->contentArray as $tabName => $tabContentItems) {
                    $tabContent = '';
                    foreach ($tabContentItems as $tabContentItem) {
                        $tabContent .= $tabContentItem;
                    }
                    $items[] = [
                        'name' => $tabName,
                        'content' => $tabContent,
                    ];
                }
                $content .= TabContentWidget::widget([
                    'contentClass' => 'mt-3',
                    'items' => $items,
                ]);
            } else {
                if (isset($this->contentArray['main'])) {
                    foreach ($this->contentArray['main'] as $contentItem) {
                        $content .= $contentItem;
                    }
                }
            }
        }
        return $content;
    }

    protected function alertToString(string $message, string $type): string
    {
        if ($type == 'code') {
            $alertContent = '
                <div class="alert alert-info" role="alert">
                    <pre>' . $message . '</pre>
                </div>';
        } else {
            $alertContent = '
                <div class="alert alert-' . $type . '" role="alert">
                  ' . $message . '
                </div>';
        }
        return $alertContent;
    }
}
