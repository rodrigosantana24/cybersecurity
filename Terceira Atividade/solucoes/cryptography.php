<?php
declare(strict_types=1);

function criptografarToken(string $payload, string $chave): string
{
    $iv = random_bytes(12);
    $ciphertext = openssl_encrypt($payload, 'aes-256-gcm', $chave, OPENSSL_RAW_DATA, $iv, $tag);

    if ($ciphertext === false) {
        throw new RuntimeException('Falha ao criptografar token.');
    }

    return json_encode([
        'token' => base64_encode($ciphertext . $tag),
        'iv' => base64_encode($iv),
    ], JSON_THROW_ON_ERROR);
}

function descriptografarToken(string $pacoteJson, string $chave): string
{
    $pacote = json_decode($pacoteJson, true, 512, JSON_THROW_ON_ERROR);
    $blob = base64_decode($pacote['token'] ?? '', true);
    $iv = base64_decode($pacote['iv'] ?? '', true);

    if ($blob === false || $iv === false || strlen($iv) !== 12 || strlen($blob) <= 16) {
        throw new RuntimeException('Token inválido.');
    }

    $tag = substr($blob, -16);
    $ciphertext = substr($blob, 0, -16);

    $plaintext = openssl_decrypt($ciphertext, 'aes-256-gcm', $chave, OPENSSL_RAW_DATA, $iv, $tag);
    if ($plaintext === false) {
        throw new RuntimeException('Token adulterado ou ilegível.');
    }

    return $plaintext;
}

