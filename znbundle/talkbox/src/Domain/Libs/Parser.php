<?php

namespace Untek\Bundle\TalkBox\Domain\Libs;

use Untek\Core\Text\Helpers\TextHelper;
use Untek\Framework\Telegram\Domain\Helpers\MatchHelper;


class Parser {

    public function parseFromText(string $text) {
        $lines = TextHelper::textToLines($text);
        $collection = [];
        foreach ($lines as $line) {
            $arr = str_getcsv($line, '\\', '', '');
            //$arr = explode('\\', $line, 2);
            $arr = array_map(function($text) {
                $text = trim($text, ',.?!');
                //$text = preg_replace('/([^\w]+)/i', '', $text);
                return $text;
            }, $arr);
            if(count($arr) == 3) {
                list($requestText, $response, $sort) = $arr;
                $request = MatchHelper::prepareString($requestText);
                $collection[$request][] = [
                    'request_text' => $requestText,
                    'request_token' => $request,
                    'answer' => $response,
                    'sort' => $sort,
                ];
            }
        }
        return $collection;
    }

}
