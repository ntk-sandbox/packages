<?php

namespace ZnLib\Components\Http\Helpers;

class SymfonyHttpResponseHelper
{

    public static function extractHeaders($all) {
        $headers = [];
        foreach ($all as $headerKey => $headerValues) {
            $headers[$headerKey] = $headerValues[0];
        }
        return $headers;
    }
}
