<?php

namespace ZnSandbox\Sandbox\Deployer\Domain\Tasks\Git;

use ZnLib\Components\ShellRobot\Domain\Base\BaseShell;
use ZnLib\Components\ShellRobot\Domain\Factories\ShellFactory;
use ZnLib\Components\ShellRobot\Domain\Interfaces\TaskInterface;
use ZnLib\Components\ShellRobot\Domain\Repositories\Config\ProfileRepository;
use ZnLib\Components\ShellRobot\Domain\Repositories\Shell\FileSystemShell;
use ZnSandbox\Sandbox\Deployer\Domain\Repositories\Shell\GitShell;

class GitCloneTask extends BaseShell implements TaskInterface
{

    protected $title = 'git clone from "{{repositoryLink}}", branch "{{branch}}"';
    public $directory;
    public $repositoryLink;
    public $branch;

    public function run()
    {
        $releasePath = ShellFactory::getVarProcessor()->process($this->directory);

//        $profileName = ShellFactory::getVarProcessor()->get('currentProfile');
//        $profileConfig = ProfileRepository::findOneByName($profileName);
        $git = new GitShell($this->remoteShell);
        $git->setDirectory($releasePath);

        $fs = new FileSystemShell($this->remoteShell);
        $fs->makeDirectory($releasePath);
        if (!$fs->isDirectoryExists($releasePath . '/.git')) {
            $git->clone($this->repositoryLink, $this->branch ?? null, $releasePath);
        } else {
            $this->io->warning('  repository already exists!');

            $this->io->writeln("  checkout to '{$this->branch}' branch ...");
            $git->checkout($this->branch);

            $this->io->writeln('  git pull ...');
            $git->pull();
        }
    }
}
