<?php
declare(strict_types=1);

function uploadImagemSeguro(array $arquivo, string $destino): string
{
    $permitidosExt = ['jpg', 'jpeg', 'png'];
    $nome = (string) ($arquivo['name'] ?? '');
    $tmp = (string) ($arquivo['tmp_name'] ?? '');
    $ext = strtolower(pathinfo($nome, PATHINFO_EXTENSION));

    if (!in_array($ext, $permitidosExt, true)) {
        throw new RuntimeException('Extensão não permitida.');
    }

    $mime = (new finfo(FILEINFO_MIME_TYPE))->file($tmp);
    if (!in_array($mime, ['image/jpeg', 'image/png'], true) || getimagesize($tmp) === false) {
        throw new RuntimeException('Arquivo não é imagem válida.');
    }

    $arquivoSeguro = bin2hex(random_bytes(16)) . '.' . $ext;
    $caminhoFinal = rtrim($destino, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $arquivoSeguro;

    if (!move_uploaded_file($tmp, $caminhoFinal)) {
        throw new RuntimeException('Falha ao mover upload.');
    }

    return $arquivoSeguro;
}

