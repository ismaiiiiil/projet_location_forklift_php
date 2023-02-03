<?php

namespace database;

use PDO;

class DB {
    // private $id;
    protected  static $db;

    // function getId() {
    //     return $this->id;
    // }

    static function connection() 
    {
        if( is_null(static::$db)) { // === null
            static::$db = new PDO('mysql:host=localhost;dbname=forklift_location;charset=utf8', 'root', '');
            // var_dump('APPEL');
        } 
        // var_dump('APPEL');
        return static::$db;
    }
}