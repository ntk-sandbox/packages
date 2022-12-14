<?php

namespace ZnFramework\Console\Symfony4\Widgets;

class LogWidget extends BaseWidget
{

    private $pretty = false;
    private $lineLength = 30;

    public function isPretty(): bool
    {
        return $this->pretty;
    }

    public function setPretty(bool $pretty): void
    {
        $this->pretty = $pretty;
    }

    public function getLineLength(): int
    {
        return $this->lineLength;
    }

    public function setLineLength(int $lineLength): void
    {
        $this->lineLength = $lineLength;
    }

    public function start(string $message)
    {
        $dots = $this->generatePadding(mb_strlen($message));
        $this->output->write("<fg=white>{$message} {$dots} </>");
    }

    public function finishSuccess(string $message = 'OK')
    {
        $this->output->writeln("<fg=green>{$message}</>");
    }

    public function finishFail(string $message = 'FAIL')
    {
        $this->output->writeln("<fg=red>{$message}</>");
    }

    protected function generatePadding(int $messageLength): string
    {
        if ($this->isPretty()) {
            $rest = $this->lineLength - $messageLength;
        } else {
            $rest = 3;
        }
        if ($rest < 3) {
            $rest = 3;
        }
        return str_repeat('.', $rest);
    }
}
