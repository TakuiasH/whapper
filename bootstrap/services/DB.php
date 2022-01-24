<?php

namespace bootstrap\services;

use bootstrap\models\Migration;
use ClanCats\Hydrahon\Builder;
use ClanCats\Hydrahon\Query\Sql\FetchableInterface;
use ClanCats\Hydrahon\Query\Sql\Insert;
use ClanCats\Hydrahon\Query\Sql\Table;
use PDO;

class DB {

    public static $connection;

    private static $builder = null;
    private static $migrations = [];

    public function __construct() {
        self::$connection = new PDO('mysql:host='.database_config['host'].';dbname='.database_config['database'].';charset=utf8', database_config['username'], database_config['password']);
        self::loadBuilder();
        self::loadMigrations();
    }
    
    public static function table(string $table) : Table {
        if(is_null(self::$builder))
            return null;
            
        return self::$builder->table($table);
    }

    public static function executeMigrations() {
        foreach(self::$migrations as $migration){
            $migration->execute(self::$connection);
        }
    }

    public static function dropMigrations() {
        foreach(self::$migrations as $migration){
            $migration->drop(self::$connection);
        }
    }

    private static function loadBuilder()  {
        if(!database_config['use']) return;    

        $connection = self::$connection;
        
        self::$builder = new Builder('mysql', function($result, $query, $params) use($connection) {
            $stm = $connection->prepare($query);
            $stm->execute($params);
        
            if ($result instanceof FetchableInterface) return $stm->fetchAll(PDO::FETCH_ASSOC);
            elseif($result instanceof Insert) return $connection->lastInsertId();
            else return $stm->rowCount();
        });
    }

    private static function loadMigrations() {
        require_once "..\bootstrap\models\Migration.php";

        foreach(scandir("..\database") as $value) {
            if(str_ends_with($value, ".migration.php")){
                include "..\database\\".$value;
                
                $instance = new (str_replace(".migration.php", "", $value));
                if($instance instanceof Migration){
                    self::$migrations = array_merge(self::$migrations, [$instance]);
                }
            }
        }
    }
}