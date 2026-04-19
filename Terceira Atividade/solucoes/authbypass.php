<?php
declare(strict_types=1);

function exigirAdmin(array $session): void
{
    if (!isset($session['user'])) {
        http_response_code(401);
        exit('Não autenticado.');
    }

    if ($session['user'] !== 'admin') {
        http_response_code(403);
        exit('Não autorizado.');
    }
}

