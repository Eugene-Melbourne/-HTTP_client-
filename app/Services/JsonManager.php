<?php

namespace App\Services;

class JsonManager
{


    public function json_encode($in): ?string
    {
        $json = json_encode($in, JSON_THROW_ON_ERROR | JSON_INVALID_UTF8_SUBSTITUTE);

        $haystack = ['null', '[]', '{}', '""'];

        if (in_array($json, $haystack)) {

            return null;
        }

        return $json;
    }


    /**
     * @return mixed
     */
    public function json_decode(?string $in)
    {
        $haystack = [null, 'null', '[]', '{}', '""'];

        if (in_array($in, $haystack)) {

            return null;
        }

        $value = json_decode($in, true, 512, JSON_THROW_ON_ERROR | JSON_INVALID_UTF8_SUBSTITUTE);

        return $value;
    }


}
