<?php

namespace Untek\Bundle\Storage\Domain\Interfaces\Services;

use Untek\Bundle\Storage\Domain\Entities\FileEntity;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface UploadServiceInterface
{

    public function uploadFile(int $serviceId, int $entityId, UploadedFile $uploadedFile): FileEntity;

    public function makeFile(int $serviceId, ?int $entityId, string $relativeFileName, string $content): FileEntity;

}
