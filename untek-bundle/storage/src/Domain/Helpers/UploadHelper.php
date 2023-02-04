<?php

namespace Untek\Bundle\Storage\Domain\Helpers;

class UploadHelper
{

//    public static function makeEntityByContent(FileEntity $fileEntity, string $relativeFileName, string $content): FileEntity
//    {
//        $fileEntity->setName(FileHelper::fileNameOnly($relativeFileName));
//        $fileEntity->setExtension(FileHelper::fileExt($relativeFileName));
//        /** @var FileHash $fileHash */
//        $fileHash = ContainerHelper::getContainer()->get(FileHash::class);
//        $fileEntity->setHash($fileHash->getHashFromContent($content));
//        $fileEntity->setSize(strlen($content));
//        return $fileEntity;
//    }

//    public static function prepareEntityFromUploaded(FileEntity $fileEntity, SymfonyUploadedFile $uploadedFile): FileEntity
//    {
//        /** @var FileHash $fileHash */
//        $fileHash = ContainerHelper::getContainer()->get(FileHash::class);
//        $hashString = $fileHash->getHashFromFileName($uploadedFile->getRealPath());
//        $name = FileHelper::fileNameOnly($uploadedFile->getClientOriginalName());
//        $fileEntity->setHash($hashString);
//        $fileEntity->setName($name);
//        $fileEntity->setExtension($uploadedFile->getClientOriginalExtension());
//        $fileEntity->setSize($uploadedFile->getSize());
//        return $fileEntity;
//    }

//    public static function getTargetFileNameFromUploaded(SymfonyUploadedFile $uploadedFile)
//    {
//        $ext = FileHelper::fileExt($uploadedFile->getClientOriginalName());
//        /** @var FileHash $fileHash */
//        $fileHash = ContainerHelper::getContainer()->get(FileHash::class);
//        $hash = $fileHash->getHashFromFileName($uploadedFile->getRealPath());
//        return self::getTargetFileName($hash, $ext);
//    }

//    public static function getTargetFileName(string $hash, string $ext): string
//    {
//        $arr = str_split($hash, 1);
//        $pathArr = array_slice($arr, 0, 2);
//        $path = implode('/', $pathArr);
//
//        $fileName = $hash{0} . '/' . $hash{1} . '/' . $hash;
//        dd($path, $fileName);
//        if ($ext) {
//            $fileName .= '.' . $ext;
//        }
//        return $fileName;
//    }

//    private static function getHashFromContent(string $content)
//    {
//        $hash = hash(HashAlgoEnum::SHA1, $content, true);
//
//        /*$hash = hash(HashAlgoEnum::CRC32B, $content, true);
//        $size = strlen($content);
//        dd(
//            SafeBase64Helper::encode($hash),
//            SafeBase64Helper::encode($hash.pow(2, 32)),
//            SafeBase64Helper::encode(pow(2, 32))
//        );*/
//        //O2BiARu7t5yFZTfy98rfFsEilF40Mjk0OTY3Mjk2
//        return SafeBase64Helper::encode($hash);
//    }
//
//    private static function getHashFromFileName(string $fileName)
//    {
//        $hash = hash_file(HashAlgoEnum::SHA1, $fileName, true);
//        return SafeBase64Helper::encode($hash);
//    }
}
