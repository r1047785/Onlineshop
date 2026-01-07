<?php

class UserRepository
{
    public function __construct(private PDO $pdo) {}

    public function emailExists(string $email): bool
    {
        $stmt = $this->pdo->prepare(
            "SELECT id FROM users WHERE email = ? LIMIT 1"
        );
        $stmt->execute([$email]);
        return (bool) $stmt->fetch();
    }

    public function create(string $name, string $email, string $password): void
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->pdo->prepare(
            "INSERT INTO users (name, email, password_hash)
             VALUES (?, ?, ?)"
        );
        $stmt->execute([$name, $email, $hash]);
    }
}
