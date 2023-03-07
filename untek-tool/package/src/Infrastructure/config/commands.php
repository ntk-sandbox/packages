<?php

use Untek\Framework\Console\Symfony4\Interfaces\CommandConfiguratorInterface;
use Untek\Tool\Package\Commands\DepsCommand;
use Untek\Tool\Package\Commands\DepsUnusedCommand;
use Untek\Tool\Package\Commands\GitBranchByVersionCommand;
use Untek\Tool\Package\Commands\GitBranchCheckoutToRootCommand;
use Untek\Tool\Package\Commands\GitBranchCommand;
use Untek\Tool\Package\Commands\GitChangedCommand;
use Untek\Tool\Package\Commands\GithubOrgsCommand;
use Untek\Tool\Package\Commands\GitNeedReleaseCommand;
use Untek\Tool\Package\Commands\GitPullCommand;
use Untek\Tool\Package\Commands\GitPushCommand;
use Untek\Tool\Package\Commands\GitStashAllCommand;
use Untek\Tool\Package\Commands\GitVersionCommand;

return function (CommandConfiguratorInterface $commandConfigurator) {
    $commandConfigurator->registerCommandClass(DepsCommand::class);
    $commandConfigurator->registerCommandClass(DepsUnusedCommand::class);
    $commandConfigurator->registerCommandClass(GitBranchByVersionCommand::class);
    $commandConfigurator->registerCommandClass(GitBranchCheckoutToRootCommand::class);
    $commandConfigurator->registerCommandClass(GitBranchCommand::class);
    $commandConfigurator->registerCommandClass(GitChangedCommand::class);
    $commandConfigurator->registerCommandClass(GithubOrgsCommand::class);
    $commandConfigurator->registerCommandClass(GitNeedReleaseCommand::class);
    $commandConfigurator->registerCommandClass(GitPullCommand::class);
    $commandConfigurator->registerCommandClass(GitPushCommand::class);
    $commandConfigurator->registerCommandClass(GitStashAllCommand::class);
    $commandConfigurator->registerCommandClass(GitVersionCommand::class);
};
