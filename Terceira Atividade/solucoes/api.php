<?php
declare(strict_types=1);

function exigirOAuth2(array $server, callable $validadorToken): string
{
    $authorization = $server['HTTP_AUTHORIZATION'] ?? '';

    if (!preg_match('/^Bearer\s+(.+)$/', $authorization, $matches)) {
        throw new RuntimeException('Authorization Bearer token ausente.');
    }

    $token = trim($matches[1]);
    if ($token === '' || !$validadorToken($token)) {
        throw new RuntimeException('Token inválido.');
    }

    return $token;
}

