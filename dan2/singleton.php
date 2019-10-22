<?php

class DB {

    private static $instance = null;

    private function __construct(){}  //ne može se instancirati

    public static function getInstance(){
        if (!self::$instance) {
           self::$instance = new DB();  //instancira se unutar klase
        }
        return self::$instance;
    }
}

// $db = new DB(); => OVO NE
$db = DB::getInstance();