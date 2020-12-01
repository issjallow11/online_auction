<?php

class Database {

    private static $host = "localhost";
    private static $username = "phpmyadmin";
    private static $password = "@cayor!!";
    private static $dbname = "online";
    private static $connection =  null;

public static function connect(){
    try{

        $dsn ='mysql:host=' .self::$host. ';dbname=' .self::$dbname;
        self::$connection = new PDO($dsn,self::$username,self::$password);
    }
    catch(PDOException $e){
        die($e->getMessage());
    }

    return self::$connection;

}

public static function disconnect(){
    self::$connection = null;
}

}

?>
