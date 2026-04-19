<?php
declare(strict_types=1);

function escaparSaidaHtml(string $entrada): string
{
    return htmlspecialchars($entrada, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

