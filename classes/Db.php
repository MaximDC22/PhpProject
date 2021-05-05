<?php
class Db{

    private static $conn;

    public static function getConnection()
    {
        include_once(__DIR__ . "/../settings/settings.php");
        if (self::$conn == NULL) {


            self::$conn = new PDO('mysql:host=' . SETTINGS['db']['host'] . '; dbname=' . SETTINGS['db']['dbname'], SETTINGS['db']['user'], SETTINGS['db']['password']);

            return self::$conn;
        } else {
            //connection found, return connection
            return self::$conn;
        }
    }
}
