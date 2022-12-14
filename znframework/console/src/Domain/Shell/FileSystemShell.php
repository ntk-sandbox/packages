<?php

namespace ZnFramework\Console\Domain\Shell;

use ZnFramework\Console\Domain\Base\BaseShellNew;
use ZnFramework\Console\Domain\Libs\ShellParsers\ShellItemsParser;

/**
 * @deprecated
 */
class FileSystemShell extends BaseShellNew
{

    /**
     * @param string $path
     * @return array
     * @deprecated
     * @see \ZnLib\Components\ShellRobot\Domain\Repositories\Shell\FileSystemShell::list()
     */
    public function directoryFiles(string $path): array
    {
        $commandOutput = $this->runCommand(['ls', '-la'], $path);
        $parser = new ShellItemsParser([$this, 'parseLine'], [$this, 'filterItem']);
        $items = $parser->parse($commandOutput);
        return $items;
    }

    public function filterItem(array $item): bool
    {
        return !in_array($item['fileName'], ['.', '..']);
    }

    public function parseLine(string $line): ?array
    {
        $isMatch = preg_match('/(\S+)\s+(\d+)\s+(\S+)\s+(\S+)\s+(\d+)\s+(\S+)\s+(\d+)\s+(\S+)\s+(\S+)/ix', $line, $matches);
        if ($isMatch) {
            $item = [
                'permission' => $matches[1],
                'type' => intval($matches[2]),
                'user' => $matches[3],
                'group' => $matches[4],
                'size' => intval($matches[5]),
                'month' => $matches[6],
                'day' => intval($matches[7]),
                'time' => $matches[8],
                'fileName' => $matches[9],
            ];
            $types = [
                1 => 'file',
                2 => 'dir',
                3 => 'sys',
            ];
            $item['type'] = $types[$item['type']] ?? $item['type'];
            return $item;
        }
        return null;
    }
}
