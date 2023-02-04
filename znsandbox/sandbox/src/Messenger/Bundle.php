<?php

namespace Untek\Sandbox\Sandbox\Messenger;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Messenger\Command\ConsumeMessagesCommand;
use Untek\Core\Bundle\Base\BaseBundle;
use Untek\Core\EventDispatcher\Interfaces\EventDispatcherConfiguratorInterface;
use Untek\Core\Instance\Libs\Resolvers\ArgumentMetadataResolver;
use Untek\Core\Instance\Libs\Resolvers\InstanceResolver;
use Untek\Core\Instance\Libs\Resolvers\MethodParametersResolver;
use Untek\Core\Instance\Libs\Resolvers\MethodParametersResolver2;
use Untek\Core\Instance\Metadata\ArgumentMetadataFactory;
use Untek\Framework\Console\Symfony4\Libs\CommandConfigurator;
use Untek\Sandbox\Sandbox\Messenger\Commands\ConsumeMessageCommand;

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
            'Untek\Sandbox\Sandbox\Messenger\Commands',
        ]);*/
        
//        example 4
        /*$command = $container->get(ConsumeMessageCommand::class);
        $application->add($command);*/
    }

    /*public function console(): array
    {
        return [
//            'Untek\Sandbox\Sandbox\Messenger\Commands',
        ];
    }*/
}
