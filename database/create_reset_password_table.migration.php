<?php

use bootstrap\models\Migration;

class create_reset_password_table implements Migration {
    
    public function execute($connection) {
        $connection->query('CREATE TABLE IF NOT EXISTS reset_password(
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(319) UNIQUE,
            token VARCHAR(32)
            );');
    }

    public function drop($connection) {
        $connection->query('DROP TABLE reset_password');
    }

}