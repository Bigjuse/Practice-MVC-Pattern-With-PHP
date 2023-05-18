<?php

namespace App;

class Request
{

    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'];
        $position = strpos($path, '?');

        if (!$position) {
            return $path;
        }

        $path = str_split($path, $position);
        return $path[0];
    }

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}
