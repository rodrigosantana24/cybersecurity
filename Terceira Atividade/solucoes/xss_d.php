<?php
declare(strict_types=1);

function respostaJsonSegura(array $dados): string
{
    return json_encode(
        $dados,
        JSON_THROW_ON_ERROR
        | JSON_HEX_TAG
        | JSON_HEX_AMP
        | JSON_HEX_APOS
        | JSON_HEX_QUOT
    );
}

