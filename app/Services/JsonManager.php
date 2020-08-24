<?php

namespace App\Services;

use App\Exceptions\JsonDecodeException;

class JsonManager
{


    private static function utf8_encode(array $in): array
    {
        $newArray = [];
        foreach ($in as $key => $record) {
            $key = utf8_encode($key);
            if (is_array($record)) {
                $newArray[$key] = self::utf8_encode($record);
            } elseif (is_object($record)) {
                $newArray[$key] = self::utf8_encode((array) $record);
            } else {
                $newArray[$key] = utf8_encode($record);
            }
        }

        return $newArray;
    }


    public function json_encode($in): string
    {
        if (is_object($in)) {
            $in = (array) $in;
        }

        if (is_array($in)) {
            $in = self::utf8_encode($in);
        }

        $json = json_encode($in);

        return $json;
    }


    public function json_decode(string $in = null): array
    {
        if (is_null($in)) {

            return [];
        }

        $array = json_decode($in, true);

        if (is_null($array)) {

            throw new JsonDecodeException();
        }

        return $array;
    }


}
