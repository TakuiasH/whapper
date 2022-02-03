<?php namespace bootstrap\models;

class Request { 

    private array $get = [];
    private array $post = [];
    private string $method;
    private string $current_path;

    public function __construct(array $get, array $post, string $method, string $current_path)
    {
        $this->get = $get;
        $this->post = $post;
        $this->method = $method;
        $this->current_path = $current_path;
    }

    public function get() : object { return (object) $this->get; }
    public function post() : object { return (object) $this->post; }
    public function method() : string { return $this->method; }
    public function current_path() : string { return $this->current_path; }

    public function has_get() : bool { return !empty($this->get); }
    public function has_post() : bool { return !empty($this->post); }
}