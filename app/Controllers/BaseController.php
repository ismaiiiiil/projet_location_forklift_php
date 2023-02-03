<?php

namespace app\Controllers;

class BaseController 
{
    static function redirect($name) { // sans data
        header("location: $name.php");
    }

    static function set($type, $message) {
        setcookie($type, $message, time() + 5, "/");
    }
}