<?php
declare(strict_types=1);

function destinoSeguroDeRedirect(int $redirectId): string
{
    $allowlist = [
        1 => 'info.php?id=1',
        2 => 'info.php?id=2',
        99 => 'https://digi.ninja',
    ];

    if (!array_key_exists($redirectId, $allowlist)) {
        throw new RuntimeException('Destino de redirecionamento inválido.');
    }

    return $allowlist[$redirectId];
}

