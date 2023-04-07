<?php

namespace Untek\Component\Encoder\Encoders;

use Untek\Core\Instance\Helpers\InstanceHelper;
use Untek\Core\Contract\Encoder\Interfaces\EncoderInterface;
use Untek\Core\Collection\Interfaces\Enumerable;

/**
 * Агрегатный кодер
 *
 * Содержит в себе инстансы других кодеров.
 *
 * При кодировании/декодировании вызывает соответствующие методы вложенных кодеров.
 * Агрегатный кодер пригодится, когда необходимо реализовать "матрешку" из форматов, например - .tar.gz
 *
 * @todo переименовать в ChainEncoder
 */
class ChainEncoder extends BaseChainEncoder implements EncoderInterface
{

    /**
     * ChainEncoder constructor.
     * @param Enumerable|EncoderInterface[] $encoderCollection Коллекция кодеров
     */
    public function __construct(Enumerable $encoderCollection)
    {
        $this->encoderCollection = $encoderCollection;
    }
}
