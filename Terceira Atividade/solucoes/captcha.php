<?php
declare(strict_types=1);

function validarCaptchaECsrf(bool $captchaOk, string $tokenRequest, string $tokenSessao): bool
{
    if (!hash_equals($tokenSessao, $tokenRequest)) {
        return false;
    }

    return $captchaOk;
}

