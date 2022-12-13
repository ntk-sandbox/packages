<?php

namespace ZnSandbox\Sandbox\Deployer\Domain\Tasks\PhpUnit;

use ZnLib\Components\ShellRobot\Domain\Base\BaseShell;
use ZnLib\Components\ShellRobot\Domain\Factories\ShellFactory;
use ZnLib\Components\ShellRobot\Domain\Interfaces\TaskInterface;
use ZnSandbox\Sandbox\Deployer\Domain\Repositories\Shell\PhpUnitShell;

class RunPhpUnitTestTask extends BaseShell implements TaskInterface
{

    protected $title = 'PhpUnit. Run tests';
    public $profile;

    public function run()
    {
        $phpUnitShell = new PhpUnitShell($this->remoteShell);
        $phpUnitShell->setDirectory(ShellFactory::getVarProcessor()->get('releasePath'));
        $out = $phpUnitShell->run();
        $isMatch1 = preg_match('/OK \((\d+) tests, (\d+) assertions\)/', $out, $matches1);
        $isMatch2 = preg_match('/Time: (.+), Memory: (.+ \w+)/', $out, $matches2);
        if ($isMatch1 && $isMatch2) {
            $res = [];
            $res['testCount'] = $matches1[1];
            $res['assertCount'] = $matches1[2];

            $res['time'] = $matches2[1];
            $res['memory'] = $matches2[2];

            $this->io->success($matches1[0] . PHP_EOL . $matches2[0]);

//            $this->io->writelnListItem("testCount: {$res['testCount']}");
//            $this->io->writelnListItem("assertCount: {$res['assertCount']}");
//            $this->io->writelnListItem("time: {$res['time']}");
//            $this->io->writelnListItem("memory: {$res['memory']}");
//            $this->io->success('OK');
        } else {
            $this->io->error('Fail');
        }
    }
}
