<?php

namespace App\Core\Abstractions;

use http\Exception;
use JsonException;

class Response
{
    protected int $statusCode;
    protected mixed $headers;
    protected mixed $body;

    public function __construct( $body = '', $statusCode = 200,  $headers = [])
    {
        $this->body = $body;
        $this->statusCode = $statusCode;
        $this->headers = $headers;
    }

    public function send(): void
    {
        http_response_code($this->statusCode);

        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }

        echo $this->body;
    }

    /**
     * @throws JsonException
     */
    public static function json(array $data, int $statusCode = 200 ): void
    {
        header("Content-Type: application/json");
        http_response_code($statusCode);
        echo json_encode($data, JSON_THROW_ON_ERROR);
    }

    /**
     * @throws JsonException
     */
    public static function error(\Throwable $error, $code = 500): void
    {
        header("Content-Type: application/json");
        http_response_code($code);
        echo json_encode([
            "error" => $error->getMessage(),
            "code" => $code,
            "file" => $error->getFile(),
            "line" => $error->getLine()
        ], JSON_THROW_ON_ERROR);
    }
}
