<?php namespace bootstrap\models;

interface Migration {
    public function execute($connection);
    public function drop($connection);
}