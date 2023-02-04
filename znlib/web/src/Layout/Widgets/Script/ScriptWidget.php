<?php

namespace Untek\Lib\Web\Layout\Widgets\Script;

use Untek\Bundle\Notify\Domain\Interfaces\Services\ToastrServiceInterface;
use Untek\Lib\Web\View\Resources\Js;
use Untek\Lib\Web\Widget\Base\BaseWidget2;

class ScriptWidget extends BaseWidget2
{

    private $js;

    public function __construct(Js $js)
    {
        $this->js = $js;
    }

    public function run(): string
    {
        return $this->getView()->renderFile(
            __DIR__ . '/views/script.php', [
            'js' => $this->js,
        ]);
    }
}
