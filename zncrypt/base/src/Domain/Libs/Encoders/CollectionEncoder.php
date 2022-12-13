<?php

namespace ZnCrypt\Base\Domain\Libs\Encoders;

use Psr\Container\ContainerInterface;
use ZnCore\Container\Traits\ContainerAwareTrait;
use ZnCore\Instance\Helpers\InstanceHelper;
use ZnCore\Contract\Encoder\Interfaces\DecodeInterface;
use ZnCore\Contract\Encoder\Interfaces\EncodeInterface;
use ZnCore\Collection\Interfaces\Enumerable;
use ZnDomain\Entity\Helpers\EntityHelper;

class CollectionEncoder implements EncoderInterface
{

    use ContainerAwareTrait;

    private $encoderCollection;

    public function __construct(Enumerable $encoderCollection, ContainerInterface $container = null)
    {
        $this->encoderCollection = $encoderCollection;
        $this->setContainer($container);
    }

    public function encode($data)
    {
        $data = EntityHelper::toArray($data);
        $encoders = $this->encoderCollection->toArray();
        foreach ($encoders as $encoderClass) {
            /** @var EncodeInterface $encoderInstance */
//            (new InstanceResolver($this->ensureContainer()))->ensure();
            $encoderInstance = InstanceHelper::ensure($encoderClass, [], $this->ensureContainer());
            $data = $encoderInstance->encode($data);
        }
        return $data;
    }

    public function decode($data)
    {
        $encoders = $this->encoderCollection->toArray();
        $encoders = array_reverse($encoders);
        foreach ($encoders as $encoderClass) {
            /** @var DecodeInterface $encoderInstance */
            $encoderInstance = InstanceHelper::ensure($encoderClass, [], $this->ensureContainer());
            $data = $encoderInstance->decode($data);
        }
        return $data;
    }
}
