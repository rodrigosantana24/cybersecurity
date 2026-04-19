<?php
declare(strict_types=1);

function validarNoServidor(int $resultadoRecebido, int $esperado, string $token, string $tokenSessao): bool
{
    if (!hash_equals($tokenSessao, $token)) {
        return false;
    }

    return $resultadoRecebido === $esperado;
}

