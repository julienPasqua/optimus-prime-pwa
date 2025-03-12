<?php
class DB {
    private static $db_host = "localhost";
    private static $db_user = "roni4736_optimus_prime";
    private static $db_password = "e[4ek}!KB_8F";
    private static $db_tableName = "roni4736_optimus_prime";
    private static $pdo;


    public static function connect(): PDO {
        if (self::$pdo === null) {
            self::$pdo = new PDO("mysql:host=" . self::$db_host . ";dbname=" . self::$db_tableName, self::$db_user, self::$db_password);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }

}