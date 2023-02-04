<?php

namespace Untek\Bundle\Storage\Domain\Dto;

class MatchDto
{

    private $fileName;
    private $mime;
    private $content;
    private $srcAttribute;

    public function getFileName()
    {
        return $this->fileName;
    }

    public function setFileName($fileName): void
    {
        $this->fileName = $fileName;
    }

    public function getMime()
    {
        return $this->mime;
    }

    public function setMime($mime): void
    {
        $this->mime = $mime;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content): void
    {
        $this->content = $content;
    }

    public function getSrcAttribute()
    {
        return $this->srcAttribute;
    }

    public function setSrcAttribute($srcAttribute): void
    {
        $this->srcAttribute = $srcAttribute;
    }
}
