<?php

namespace ZnBundle\Storage\Domain\Libs;

use ZnCore\Contract\Common\Exceptions\InvalidConfigException;
use ZnCrypt\Base\Domain\Enums\HashAlgoEnum;
use ZnCrypt\Base\Domain\Helpers\SafeBase64Helper;

class FileHash
{

    private $algorithm;
    private $includeSize;
    private $directorySize;
    private $directoryCount;
    private $encoder;

    public function __construct(string $algorithm = HashAlgoEnum::SHA256, bool $includeSize = false, int $directorySize, int $directoryCount, string $encoder)
    {
        $this->algorithm = $algorithm;
        $this->includeSize = $includeSize;
        $this->directorySize = $directorySize;
        $this->directoryCount = $directoryCount;
        $this->encoder = $encoder;
    }

    public function getPath(string $hash, string $ext): string
    {
        $formattedHash = $this->encodeHashForPath($hash);
        $fileName = $this->getPurePath($formattedHash) . $hash;
        if ($ext) {
            $fileName .= '.' . $ext;
        }
        return $fileName;
    }

    private function getPurePath(string $formattedHash): string
    {
        $nestList = str_split($formattedHash, $this->directorySize);
        $pathArr = array_slice($nestList, 0, $this->directoryCount);
        $path = implode('/', $pathArr);
        return $path . '/';
    }

    public function getHashFromContent(string $content)
    {
        $rawHash = hash($this->algorithm, $content, true);
        $size = strlen($content);
        return $this->encode($rawHash, $size);
    }

    public function getHashFromFileName(string $fileName)
    {
        $rawHash = hash_file($this->algorithm, $fileName, true);
        $size = filesize($fileName);
        return $this->encode($rawHash, $size);
    }

    private function encodeHashForPath(string $hash): string
    {
        if($this->encoder == 'base64') {
            return $hash;
        }
        if($this->encoder == 'hex') {
            $rawHash = base64_decode($hash);
            return bin2hex($rawHash);
        }
        throw new InvalidConfigException('Invalid ENV parameter "STORAGE_PATH_ENCODER"!');
    }

    private function encode(string $rawHash, int $size)
    {
        $scope = $rawHash;
        $encodedScope = SafeBase64Helper::encode($scope);
        if($this->includeSize) {
            $encodedScope .= SafeBase64Helper::encode($size);
        }
        return $encodedScope;
    }
}
