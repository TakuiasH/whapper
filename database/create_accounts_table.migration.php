<?php

use bootstrap\models\Migration;

class create_accounts_table implements Migration {
    
    public function execute($connection) { 
        $connection->query('CREATE TABLE IF NOT EXISTS accounts(
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(32) UNIQUE,
            email VARCHAR(319) UNIQUE,
            password VARCHAR(255),
            locale VARCHAR(7)
            );');
    }

    public function drop($connection) {
        $connection->query('DROP TABLE accounts');
    }

}