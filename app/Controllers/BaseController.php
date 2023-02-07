<?php

namespace app\Controllers;

class BaseController 
{
    static function redirect($name) { // sans data
        header("Location: $name.php");
    }

    static function set($type, $message) {
        setcookie($type, $message, time() + 5, "/");
    }
}