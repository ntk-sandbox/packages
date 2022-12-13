<?php

namespace ZnSandbox\Sandbox\Apache\Domain\Helpers;

use ZnDomain\Entity\Helpers\EntityHelper;
use ZnDomain\Domain\Interfaces\DomainInterface;
use ZnSandbox\Sandbox\Apache\Domain\Entities\HostEntity;

class HostsParser {

    public static function parse(string $content) {
        $lines = explode(PHP_EOL, $content);
        $cleanLines = self::clean($lines);
        $collection = [];
        foreach ($cleanLines as $line) {
            $lineArr = preg_split('/([\t\s]+)/i', $line);
            $item = [];
            $item['ip'] = $lineArr[0];
            $item['host'] = $lineArr[1];
            $collection[$item['host']] = $item;
        }
        return $collection;
    }

    private static function clean(array $lines): array {
        $cleanLines = [];
        foreach ($lines as $line) {
            $line = explode('#', $line)[0];
            $line = trim($line, "\ \t\n\r\0\x0B");
            if(empty($line) || $line[0] == '#') {

            } else {
                $cleanLines[] = $line;
            }
        }
        return $cleanLines;
    }

}
