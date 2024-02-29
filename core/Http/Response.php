<?php

namespace Core\http;

class Response
{
    public function statusCode(int $code)
    {
        http_response_code($code);
        return $this;
    }

    public function json($data)
    {
        header("Content-Type: application/json");
        echo json_encode($data);
        exit();
    }

    public function end(): void
    {
        die();
    }

    public function redirect(string $target): void
    {
        header("Location: $target");
        die();
    }
}
