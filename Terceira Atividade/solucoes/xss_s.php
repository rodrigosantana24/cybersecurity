<?php
declare(strict_types=1);

function salvarComentarioSeguro(PDO $db, string $nome, string $mensagem): void
{
    $stmt = $db->prepare('INSERT INTO guestbook (name, comment) VALUES (:n, :c)');
    $stmt->bindValue(':n', $nome, PDO::PARAM_STR);
    $stmt->bindValue(':c', $mensagem, PDO::PARAM_STR);
    $stmt->execute();
}

function renderizarComentarioSeguro(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

