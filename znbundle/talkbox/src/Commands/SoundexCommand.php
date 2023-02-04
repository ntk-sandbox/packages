<?php

namespace Untek\Bundle\TalkBox\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Untek\Bundle\TalkBox\Domain\Entities\TagEntity;
use Untek\Bundle\TalkBox\Domain\Services\TagService;
use Untek\Core\Container\Helpers\ContainerHelper;
use Untek\Core\Collection\Interfaces\Enumerable;

class SoundexCommand extends Command
{

    protected static $defaultName = 'dialog:soundex';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('<fg=white># Test</>');
        $container = ContainerHelper::getContainer();
        /** @var TagService $answerService */
        $answerService = $container->get(TagService::class);
        /** @var TagEntity[] | Enumerable $collection */
        $collection = $answerService->findAll();
        foreach ($collection as $tagEntity) {
            $answerService->updateById($tagEntity->getId(), [
                'soundex' => $tagEntity->getSoundex(),
                'metaphone' => $tagEntity->getMetaphone(),
            ]);
        }
        return Command::SUCCESS;
    }
}
