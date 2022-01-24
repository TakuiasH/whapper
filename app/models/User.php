<?php namespace app\models;

class User {

    public string $id;
    public string $username;
    public string $email;
    public string $locale;

    function __construct($id, $username, $email, $locale) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->locale = $locale;
    }
}