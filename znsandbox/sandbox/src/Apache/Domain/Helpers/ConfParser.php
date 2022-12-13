<?php

namespace ZnSandbox\Sandbox\Apache\Domain\Helpers;

use ZnCore\FileSystem\Helpers\FileStorageHelper;
use ZnCore\FileSystem\Helpers\FindFileHelper;
use ZnDomain\Domain\Interfaces\DomainInterface;

class ConfParser {

    public static function readServerConfig(string $directory): array {
        $files = FindFileHelper::scanDir($directory, ['only' => ['*.conf']]);
        $commonTagCollection = [];
        foreach ($files as $file) {
            $content = FileStorageHelper::load($directory . '/' . $file);
            $tagCollection = self::parseConfig($content);
            $commonTagCollection = array_merge($commonTagCollection, $tagCollection);
        }
        return $commonTagCollection;
    }

    public static function parseConfig(string $content): array {
        $content = self::cleanContent($content);
        preg_match_all("/<([a-zA-Z_-]+)([^>]*)>([\s\S]+?)<\/([a-zA-Z_-]+)>/i", $content, $matches);

        $tagCollection = [];
        foreach ($matches[0] as $index => $match) {
            $entity = [];
            $entity['tagName'] = $matches[1][$index];
            $entity['tagAttributes'] = $matches[2][$index];
            //$entity['content'] = $matches[3][$index];
            $config = self::parseTagContent($matches[3][$index]);
            $entity['config'] = $config;
            $tagCollection[] = $entity;
        }
        return $tagCollection;
    }

    private static function parseTagContent(string $content): array {
        $contentLines = explode(PHP_EOL, $content);
        $config = [];
        foreach ($contentLines as $contentLine) {
            $contentLine = trim($contentLine);
            if(!empty($contentLine)) {
                preg_match("/^([a-zA-Z_-]+)\s+([^$]+)$/i", $contentLine, $configMatches);
                if(count($configMatches) > 2) {
                    list($common, $configName, $configValue) = $configMatches;
                    $config[$configName] = trim($configValue);
                }
            }
        }
        return $config;
    }

    public static function cleanContent(string $content): string {
        $lines = explode(PHP_EOL, $content);
        $cleanLines = [];
        foreach ($lines as $line) {
            $line = trim($line);
            if(!empty($line) && $line[0] == '#') {

            } else {
                $cleanLines[] = $line;
            }
        }
        $content = implode(PHP_EOL, $cleanLines);
        return $content;
    }

}
