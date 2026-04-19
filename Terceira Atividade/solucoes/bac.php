<?php
declare(strict_types=1);

function podeAcessarPerfil(int $usuarioAtualId, string $papelAtual, int $alvoId): bool
{
    return $usuarioAtualId === $alvoId || $papelAtual === 'admin';
}

function buscarPerfilSeguro(PDO $db, int $alvoId): array
{
    $stmt = $db->prepare('SELECT user_id, first_name, last_name, avatar FROM users WHERE user_id = :id LIMIT 1');
    $stmt->bindValue(':id', $alvoId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
}

