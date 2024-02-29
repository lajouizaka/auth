<?php

namespace Core;

use Core\Http\Request;
use Core\Http\Response;
use Core\support\Singleton;

class Router
{
    use Singleton;

    public Request $request;

    public Response $response;

    public static $routes = [];
    public static $not_found  = null;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
    }
    public static function get(string $path, $cb)
    {
        self::$routes["get"][$path] = $cb;
    }

    public static function post(string $path, $cb)
    {
        self::$routes["post"][$path] = $cb;
    }

    public static function delete(string $path, $cb)
    {
        self::$routes["delete"][$path] = $cb;
    }

    public static function put(string $path, $cb)
    {
        self::$routes["put"][$path] = $cb;
    }

    public static function _404($cb)
    {
        self::$not_found = $cb;
    }

    public static function resolve()
    {
        $request = self::instance()->request;
        $response = self::instance()->response;

        $method = $request->method();

        if ($method === "post") {
            if (strtolower($request->input("method")) === "delete") {
                $method = "delete";
            } elseif(strtolower($request->input("method")) === "put") {
                $method = "put";
            }
        }

        $url = $request->path();

        if (str_ends_with($url, "/")) {
            $url = substr($url, 0, strlen($url) - 1);
        }

        if (key_exists($url, self::$routes[$method])) {
            csrf_protection($request, $response);
            $cb = self::$routes[$method][$url];
            $cb($request, $response);
        } else {
            $cb = self::$not_found;
            $cb();
        }

    }
}
