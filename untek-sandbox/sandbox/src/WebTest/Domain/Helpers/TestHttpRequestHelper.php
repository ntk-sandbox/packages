<?php

namespace Untek\Sandbox\Sandbox\WebTest\Domain\Helpers;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class TestHttpRequestHelper
{

    public static function prepareHeaderKeys(array $headers): array {
        $result = [];
        foreach ($headers as $headerKey => $headerValue) {
            $headerKey = self::prepareHeaderKey($headerKey);
            $result[$headerKey] = $headerValue;
        }
        return $result;
        
        /*return collect($headers)->mapWithKeys(function ($value, $name) {
            $name = self::prepareHeaderKey($name);
            return [$name => $value];
        })->all();*/
    }

    protected static function prepareHeaderKey(string $name): string {
        return strtr(strtoupper($name), '-', '_');
    }

    /**
     * Extract the file uploads from the given data array.
     *
     * @param  array  $data
     * @return array
     */
    public static function extractFilesFromDataArray(&$data)
    {
        $files = [];

        foreach ($data as $key => $value) {
            if ($value instanceof UploadedFile) {
                $files[$key] = $value;

                unset($data[$key]);
            }

            if (is_array($value)) {
                $files[$key] = self::extractFilesFromDataArray($value);

                $data[$key] = $value;
            }
        }

        return $files;
    }

    /**
     * Transform headers array to array of $_SERVER vars with HTTP_* format.
     *
     * @param  array  $headers
     * @return array
     */
    public static function transformHeadersToServerVars(array $headers)
    {
        $headers = self::prepareHeaderKeys($headers);

        $result = [];
        foreach ($headers as $headerKey => $headerValue) {
            $headerKey = self::formatServerHeaderKey($headerKey);
            $result[$headerKey] = $headerValue;
        }
        
        return $result;
        
//        return collect($headers)->mapWithKeys(function ($value, $name) {
////            $name = self::prepareHeaderKey($name);
//
//            return [self::formatServerHeaderKey($name) => $value];
//        })->all();
    }

    /**
     * Format the header name for the server array.
     *
     * @param  string  $name
     * @return string
     */
    protected static function formatServerHeaderKey($name)
    {
        if (! str_starts_with($name, 'HTTP_') && $name !== 'CONTENT_TYPE' && $name !== 'REMOTE_ADDR') {
            return 'HTTP_'.$name;
        }

        return $name;
    }

}
