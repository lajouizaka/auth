<?php

namespace Core\http;

class Request
{
    protected $params = [];
    protected $body = [];


    public function __construct()
    {
        $this->params = $this->query();
        $this->body= $this->body();
    }

    public function path()
    {
        return parse_url($_SERVER["REQUEST_URI"])["path"];
    }

    public function method()
    {
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }

    public function isGet()
    {
        return $this->method() === "get";
    }

    public function isPost()
    {
        return $this->method() === "post";
    }

    public function isPut()
    {
        return $this->method() === "post"
                && $_POST["method"]
                && strtolower($_POST["method"])  === "put" ;
    }

    public function isDelete()
    {
        return $this->method() === "post"
                && $_POST["method"]
                && strtolower($_POST["method"])  === "delete" ;
    }

    public function body()
    {
        $body = [];

        if ($this->isPost()) {
            foreach ($_POST as $key => $value) {
                $body[$key] = $value;
            }
        }

        return $body;
    }

    public function query()
    {
        $query = [];

        if ($this->isGet()) {
            foreach ($_GET as $key => $value) {
                $query[$key] = $value;
            }
        }

        return $query;
    }

    public function param(string $name): string
    {
        return $this->params[$name] ?? "";
    }

    public function input(string $name)
    {

        return $this->body[$name] ?? "";
    }
}
