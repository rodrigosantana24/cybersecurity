<?php
declare(strict_types=1);

function resolverPaginaPermitida(string $pagina): string
{
    $allowlist = [
        'include.php' => 'include.php',
        'file1.php' => 'file1.php',
        'file2.php' => 'file2.php',
        'file3.php' => 'file3.php',
    ];

    if (!isset($allowlist[$pagina])) {
        throw new RuntimeException('Arquivo não permitido.');
    }

    return $allowlist[$pagina];
}

