<?php

namespace App;

class Request
{


    /**
     * @return mixed
     */
    public function __get(string $name)
    {
        $result = $_GET[$name] ?? null;

        return $result;
    }


}
