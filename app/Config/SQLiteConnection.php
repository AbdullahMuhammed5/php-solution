<?php

namespace App\Config;

use PDO;

class SQLiteConnection {

    /**
     * PDO instance
     */
    private static $instance;

    /**
     * return the instance of the PDO object that connects to the SQLite database
     *
     * @return PDO
     */
    public static function connect(): PDO
    {
        if (self::$instance == null) {
            self::$instance = new PDO("sqlite:" . Config::PATH_TO_SQLITE_FILE);
        }
        return self::$instance;
    }
}
