<?php
declare(strict_types=1);

function buscarUsuarioPorId(PDO $db, int $id): array
{
    $stmt = $db->prepare('SELECT first_name, last_name FROM users WHERE user_id = :id LIMIT 1');
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
}

