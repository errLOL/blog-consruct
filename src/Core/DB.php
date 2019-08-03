<?php 

namespace Phpblog\Core;

class DB
{
    private static $instance;

    public static function getConnect()
    {
        if(self::$instance === null) {
            self::$instance = self::connect();
        }
        return self::$instance;
    }
    
    private static function connect() {
        $db = sprintf('%s:host=%s;dbname=%s', 'mysql', 'localhost', 'blog_oop');
        $query = new \PDO($db, 'root', '');
        $query->exec('SET NAMES UTF8');
        return $query;
    } 
}
