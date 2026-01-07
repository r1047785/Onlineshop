<?php

class LoginService
{
    public function __construct(private UserRepository $users) {}

    /**
     * @return array{status:string, message:string, user:?array}
     */
    public function login(string $email, string $password): array
    {
        $email = trim($email);

        if ($email === "" || $password === "") {
            return ["status" => "ERROR", "message" => "Vul email en wachtwoord in.", "user" => null];
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ["status" => "ERROR", "message" => "Ongeldig email adres.", "user" => null];
        }

        $user = $this->users->findByEmail($email);

        if (!$user) {
            return ["status" => "ERROR", "message" => "Onbekend email of wachtwoord.", "user" => null];
        }

        if (!password_verify($password, $user["password_hash"])) {
            return ["status" => "ERROR", "message" => "Onbekend email of wachtwoord.", "user" => null];
        }

        return ["status" => "SUCCESS", "message" => "✅ Ingelogd!", "user" => $user];
    }
}
