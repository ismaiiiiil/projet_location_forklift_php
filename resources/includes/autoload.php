<?php

class Autoloader 
{
    static function register() {
        spl_autoload_register(static function($class) {

            $filename = $class . '.php'; // app\Controllers\HomeController
            $filename = str_replace('\\', '/', $filename);// change \ -> /

            if(file_exists($filename)) {
                require $filename;
            }
        });
    }
}