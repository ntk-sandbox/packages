<?php

namespace ZnBundle\TalkBox\Domain\Helpers;

use ZnFramework\Telegram\Domain\Helpers\MatchHelper;
use ZnBundle\TalkBox\Domain\Libs\Parser;


class WordHelper
{

    /**
     * Разбить текст на предложения
     * @param string $text
     * @return array
     */
    public static function textToSentences(string $text): array {
        $text = preg_replace('#(\.|\?|\!)#iu', '.', $text);
        $text = preg_replace('#(\s*\.+\s*)#iu', '.', $text);
        $text = preg_replace('#(\.+)#iu', '.', $text);
        $text = trim($text, '.');
        $sentences = explode('.', $text);
        return $sentences;
    }

    /*public static function textToWords($text) {
        $text = MatchHelper::prepareString($text);
        $words = StringHelper::getWordArray($text);
        return $words;
    }

    public static function wordToIntArray($strInput, $maxLen) {
        $strInput = StringHelper::fill($strInput, $maxLen, ' ');
        $chars = preg_split('//u', $strInput, NULL, PREG_SPLIT_NO_EMPTY);
        $a = [];
        foreach($chars as $char) {
            $a[] = ord($char);
        }
        return $a;
    }

    public static function createDataSet(array $arr, $maxLen) {
        $samples = [];
        $labels = [];
        foreach($arr as $key=>$values)
        {
            foreach($values as $value)
            {
                $labels[]=$key;
                $chars = preg_split('//u', $value, NULL, PREG_SPLIT_NO_EMPTY);
                $code = [];
                foreach($chars as $char)
                    $code[]= ord($char);

                if(count($code) < $maxLen)
                {
                    $i=count($code);
                    while($i<=$maxLen-1)
                    {
                        $code[]=0;
                        $i++;
                    }
                }

                $samples[]=$code;
            }
        }
        return [$labels, $samples];
    }

    public static function getMaxLen(array $arr) : int {
        $maxLen  = 0;
        foreach($arr as $key=>$values) {
            foreach($values as $value)
            {
                $chars = preg_split('//u', $value, NULL, PREG_SPLIT_NO_EMPTY);
                $code = [];
                foreach($chars as $char)
                    $code[]= ord($char);
                if (count($code)>$maxLen){
                    $maxLen=count($code);
                }
            }
        }
        return $maxLen;
    }*/
    
}