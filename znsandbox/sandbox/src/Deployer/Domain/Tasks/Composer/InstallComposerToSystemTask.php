<?php

namespace ZnSandbox\Sandbox\Deployer\Domain\Tasks\Composer;

use ZnLib\Components\ShellRobot\Domain\Interfaces\TaskInterface;
use ZnLib\Components\ShellRobot\Domain\Repositories\Shell\FileSystemShell;
use ZnLib\Components\ShellRobot\Domain\Base\BaseShell;

class InstallComposerToSystemTask extends BaseShell implements TaskInterface
{

    protected $title = 'Install composer';

    public function run()
    {
        $fs = new FileSystemShell($this->remoteShell);

        if (!$fs->isFileExists('/usr/bin/composer')) {
            $url = 'https://getcomposer.org/installer';
            $hash = '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae';
            $destFile = 'composer-setup.php';
//        $destDirectory = ConfigProcessor::get('deploy_path');
            $destFilePath = /*$destDirectory . '/' .*/
                $destFile;

            $this->remoteShell->runCommand('cd ~ && {{bin/php}} -r "unlink(\'composer . phar\');"');

//        ServerConsole::cd('~');
//        $this->remoteShell->runCommand('{{bin/php}} -r "unlink(\'composer.phar\');"');

            $this->remoteShell->runCommand("{{bin/php}} -r \"copy('$url', '$destFile');\"");
            $fs->checkFileHash($destFilePath, $hash);

            /* $this->remoteShell->runCommand('{{bin/php}} -r "copy(\'https://getcomposer.org/installer\', \'composer-setup.php\');"');
             $output = $this->remoteShell->runCommand('{{bin/php}} -r "if (hash_file(\'sha384\', \'composer-setup.php\') === \'906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8\') { echo \'Installer verified\'; } else { echo \'Installer corrupt\'; unlink(\'composer-setup.php\'); } echo PHP_EOL;"');
             if ($output != 'Installer verified') {
                 throw new \Exception('composer not verified!');
             }*/


            $this->remoteShell->runCommand('{{bin/php}} composer-setup.php');
            $this->remoteShell->runCommand('{{bin/php}} -r "unlink(\'composer-setup.php\');"');

            $fs->sudo()->move('{{homeUserDir}}/composer.phar', '/usr/bin/composer');
        } else {
            $this->io->writeln('  Composer already installed!');
        }

//        $this->remoteShell->runCommand('sudo mv ~/composer.phar /usr/bin/composer');
        $version = $this->remoteShell->runCommand('{{bin/composer}} --version');
        echo $version . PHP_EOL;
    }
}
