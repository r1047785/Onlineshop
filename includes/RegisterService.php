<?php

class RegisterService
{
    public function __construct(private UserRepository $users) {}

    public function register(string $name, string $email, string $password): string
    {
        if ($name === "" || $email === "" || $password === "") {
            return "Vul alle velden in.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Ongeldig email adres.";
        }

        if (strlen($password) < 6) {
            return "Wachtwoord moet minstens 6 tekens zijn.";
        }

        if ($this->users->emailExists($email)) {
            return "Dit email adres bestaat al.";
        }

        $this->users->create($name, $email, $password);
        return "SUCCESS";
    }
}
