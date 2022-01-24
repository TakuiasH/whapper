<?php namespace bootstrap\models;

abstract class Middleware {

    protected string $name = "";

    function __construct(string $name) {
        $this->name = $name;
    }

    public function name() : string {
        return $this->name;
    }

    public abstract function validate() : bool;

}