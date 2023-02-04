<?php

namespace Untek\Framework\Console\Symfony4\Helpers;

use Symfony\Component\Console\Output\OutputInterface;

class OutputHepler
{

    public static function writeList(OutputInterface $output, array $array)
    {
        foreach ($array as $item) {
            $output->writeln(' ' . $item);
        }
    }

}