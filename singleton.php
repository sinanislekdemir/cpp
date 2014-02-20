<?php
class Database {
    private static $db;

    private function __construct(){}

    static function get() {
        if(!isset(self::$rand))
            self::$db = new PDO('mysql:host=127.0.0.1;dbname=toto', 'user', 'pwd');

        return self::$db;
    }
}

function some_function() {
    Database::get()->query('...');
}

some_function();