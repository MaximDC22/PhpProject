<?php
class Db{


    
    private static $conn;
    
    public static function getConnection(){
        include_once(__DIR__ . "/../settings/settings.php");
        if (self::$conn != NULL)  {
            //connection found, return connection
            return self::$conn;

        }else{
            //$config = parse_ini_file("/config/config.ini");
            self::$conn = new PDO('mysql:host='. SETTINGS['db']['host'] .'; dbname='.SETTINGS['db']['db_cliptok'],SETTINGS['db']['user'],SETTINGS['db']['password']);
            //self::$conn = new PDO('mysql:host='.$config['db_host'].';dbname='.$config['db_name'],$config['db_user'],$config['db_password']);
            return self::$conn;
        }
    }
}