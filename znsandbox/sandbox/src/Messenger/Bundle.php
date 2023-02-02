<?php

namespace ZnSandbox\Sandbox\Messenger;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Messenger\Command\ConsumeMessagesCommand;
use ZnCore\Bundle\Base\BaseBundle;
use ZnCore\EventDispatcher\Interfaces\EventDispatcherConfiguratorInterface;
use ZnCore\Instance\Libs\Resolvers\ArgumentMetadataResolver;
use ZnCore\Instance\Libs\Resolvers\InstanceResolver;
use ZnCore\Instance\Libs\Resolvers\MethodParametersResolver;
use ZnCore\Instance\Libs\Resolvers\MethodParametersResolver2;
use ZnCore\Instance\Metadata\ArgumentMetadataFactory;
use ZnFramework\Console\Symfony4\Libs\CommandConfigurator;
use ZnSandbox\Sandbox\Messenger\Commands\ConsumeMessageCommand;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'messenger';
    }

    public function consoleCommands(Application $application, ContainerInterface $container, CommandConfigurator $commandConfigurator) {
//        $commandConfigurator->registerCommandClass(ConsumeMessageCommand::class);

//      example 2
        /*$callable = [ConsumeMessageCommand::class, '__construct'];
        $argumentResolver = $container->get(ArgumentMetadataResolver::class);
        $resolvedArguments = $argumentResolver->resolve($callable);
        $instanceResolver = new InstanceResolver($container);
        $command = $instanceResolver->create(ConsumeMessageCommand::class, $resolvedArguments);
        $application->add($command);
        */
        
//      example 2.5
        $instanceResolver = new InstanceResolver($container);
        $command = $instanceResolver->make(ConsumeMessageCommand::class);
        $application->add($command);
        
        // example 3
        /*$commandConfigurator->registerFromNamespaceList([
            'ZnSandbox\Sandbox\Messenger\Commands',
        ]);*/
        
//        example 4
        /*$command = $container->get(ConsumeMessageCommand::class);
        $application->add($command);*/
    }

    public function console(): array
    {
        return [
//            'ZnSandbox\Sandbox\Messenger\Commands',
        ];
    }
}
