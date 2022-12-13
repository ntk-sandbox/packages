<?php

namespace ZnBundle\Storage\Domain\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use ZnBundle\Storage\Domain\Dto\MatchDto;
use ZnBundle\Storage\Domain\Interfaces\Services\UploadServiceInterface;
use ZnCore\Code\Helpers\PropertyHelper;
use ZnCore\Collection\Interfaces\Enumerable;
use ZnCore\Collection\Libs\Collection;
use ZnCore\FileSystem\Helpers\MimeTypeHelper;
use ZnDomain\Domain\Enums\EventEnum;
use ZnDomain\Domain\Events\EntityEvent;
use ZnDomain\Entity\Interfaces\EntityIdInterface;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnDomain\EntityManager\Traits\EntityManagerAwareTrait;

class StoreHtmlResourceSubscriber implements EventSubscriberInterface
{

    use EntityManagerAwareTrait;

    public $serviceId;
    public $attribute;

    private $uploadService;

    public function __construct(
        EntityManagerInterface $entityManager,
        UploadServiceInterface $uploadService
    )
    {
        $this->setEntityManager($entityManager);
        $this->uploadService = $uploadService;
    }

    public static function getSubscribedEvents()
    {
        return [
            EventEnum::AFTER_CREATE_ENTITY => 'onBeforePersistEntity',
            EventEnum::BEFORE_UPDATE_ENTITY => 'onBeforePersistEntity',
        ];
    }

    public function onBeforePersistEntity(EntityEvent $event)
    {
        /** @var EntityIdInterface $entity */
        $entity = $event->getEntity();
        $content = PropertyHelper::getValue($entity, $this->attribute);
        $collection = $this->matchAll($content);
        if ($collection->count()) {
            foreach ($collection as $matchDto) {
                $fileEntity = $this->uploadService->makeFile($this->serviceId, $entity->getId(), $matchDto->getFileName(), $matchDto->getContent());
                $newSrcAttribute = 'src="' . $fileEntity->getUri() . '"';
                $content = str_replace($matchDto->getSrcAttribute(), $newSrcAttribute, $content);
                PropertyHelper::setValue($entity, $this->attribute, $content);
                $this->getEntityManager()->persist($entity);
            }
        }
    }

    /**
     * @param string $content
     * @return Enumerable | MatchDto[]
     */
    private function matchAll(string $content): Enumerable
    {
        $collection = new Collection();
        $isMatch = preg_match_all('/src=\"data:([^;]+);base64,([^\"]*)\"(\s+data-filename=\"([^\"]*)\")?/i', $content, $matches);
        if ($isMatch) {
            foreach ($matches[0] as $index => $value) {
                $matchDto = new MatchDto();
                $mime = $matches[1][$index];
                $matchDto->setFileName($matches[4][$index] ?? $this->forgeFileName($mime));
                $matchDto->setMime($mime);
                $matchDto->setContent(base64_decode($matches[2][$index]));
                $matchDto->setSrcAttribute($matches[0][$index]);
                $collection->add($matchDto);
            }
        }
        return $collection;
    }

    private function forgeFileName($mime): string
    {
        $ext = MimeTypeHelper::getExtensionByMime($mime);
        return 'embed image.' . $ext;
    }
}
