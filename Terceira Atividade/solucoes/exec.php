<?php
declare(strict_types=1);

function executarPingSeguro(string $ip): string
{
    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) === false) {
        throw new InvalidArgumentException('IP inválido.');
    }

    $arg = escapeshellarg($ip);
    $cmd = stripos(PHP_OS, 'WIN') === 0 ? "ping -n 4 {$arg}" : "ping -c 4 {$arg}";

    return (string) shell_exec($cmd);
}

