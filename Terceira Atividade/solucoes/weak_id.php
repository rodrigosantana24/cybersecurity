<?php
declare(strict_types=1);

function gerarSessionIdForte(): string
{
    return bin2hex(random_bytes(32));
}

function definirCookieSessaoSeguro(string $nome, string $valor, int $expiraEmSegundos): void
{
    setcookie($nome, $valor, [
        'expires' => time() + $expiraEmSegundos,
        'path' => '/',
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Strict',
    ]);
}

