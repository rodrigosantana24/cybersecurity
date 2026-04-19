<?php
declare(strict_types=1);

function trocarSenhaComCsrf(PDO $db, string $usuario, string $senhaAtual, string $novaSenha, string $csrf, string $csrfSessao): bool
{
    if (!hash_equals($csrfSessao, $csrf)) {
        return false;
    }

    $stmt = $db->prepare('SELECT password FROM users WHERE user = :u LIMIT 1');
    $stmt->bindValue(':u', $usuario, PDO::PARAM_STR);
    $stmt->execute();
    $hashAtual = (string) $stmt->fetchColumn();

    if ($hashAtual === '' || !password_verify($senhaAtual, $hashAtual)) {
        return false;
    }

    $novoHash = password_hash($novaSenha, PASSWORD_DEFAULT);
    $up = $db->prepare('UPDATE users SET password = :p WHERE user = :u');
    $up->bindValue(':p', $novoHash, PDO::PARAM_STR);
    $up->bindValue(':u', $usuario, PDO::PARAM_STR);

    return $up->execute();
}

