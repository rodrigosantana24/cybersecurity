<?php
declare(strict_types=1);

function usuarioExisteSemVazarDados(PDO $db, int $id): bool
{
    $stmt = $db->prepare('SELECT COUNT(*) FROM users WHERE user_id = :id');
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    return (int) $stmt->fetchColumn() === 1;
}

