<?php

namespace Untek\Bundle\Storage\Domain\Filters;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Untek\Domain\Components\Constraints\Enum;
use Untek\Domain\Validator\Interfaces\ValidationByMetadataInterface;
use Untek\Domain\QueryFilter\Interfaces\DefaultSortInterface;
use Untek\Lib\Components\Status\Enums\StatusSimpleEnum;

class FileFilter implements ValidationByMetadataInterface, DefaultSortInterface
{

    private $title;
    private $viewCount;
    protected $statusId = StatusSimpleEnum::ENABLED;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('statusId', new Enum([
            'class' => StatusSimpleEnum::class,
        ]));
        $metadata->addPropertyConstraint('viewCount', new Assert\PositiveOrZero());
    }

    public function setStatusId(int $value): void
    {
        $this->statusId = $value;
    }

    public function getStatusId()
    {
        return $this->statusId;
    }

    public function defaultSort(): array
    {
        return [
            'created_at' => SORT_DESC,
        ];
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getViewCount()
    {
        return $this->viewCount;
    }

    public function setViewCount($viewCount): void
    {
        $this->viewCount = $viewCount;
    }

}
