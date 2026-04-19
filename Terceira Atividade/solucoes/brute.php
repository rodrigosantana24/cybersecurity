<?php
declare(strict_types=1);

function loginComRateLimit(PDO $db, string $usuario, string $senha): bool
{
    $maxTentativas = 5;
    $janelaSegundos = 900;
    $limite = (new DateTimeImmutable())->sub(new DateInterval('PT' . $janelaSegundos . 'S'))->format('Y-m-d H:i:s');

    $rateStmt = $db->prepare(
        'SELECT COUNT(*) FROM login_attempts WHERE username = :u AND created_at > :limite'
    );
    $rateStmt->bindValue(':u', $usuario, PDO::PARAM_STR);
    $rateStmt->bindValue(':limite', $limite, PDO::PARAM_STR);
    $rateStmt->execute();

    if ((int) $rateStmt->fetchColumn() >= $maxTentativas) {
        return false;
    }

    $userStmt = $db->prepare('SELECT password FROM users WHERE user = :u LIMIT 1');
    $userStmt->bindValue(':u', $usuario, PDO::PARAM_STR);
    $userStmt->execute();
    $hash = (string) $userStmt->fetchColumn();

    $ok = $hash !== '' && password_verify($senha, $hash);

    $logStmt = $db->prepare('INSERT INTO login_attempts(username, success, created_at) VALUES(:u, :s, NOW())');
    $logStmt->bindValue(':u', $usuario, PDO::PARAM_STR);
    $logStmt->bindValue(':s', $ok ? 1 : 0, PDO::PARAM_INT);
    $logStmt->execute();

    return $ok;
}

