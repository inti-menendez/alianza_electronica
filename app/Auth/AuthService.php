<?php

class AuthService
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function authenticate($username, $password)
    {
        $query = "SELECT password_hash FROM users WHERE username = :username";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);

        $stmt->execute();

        $password_hash = $stmt->fetchColumn();

        if (password_verify($password, $password_hash)) {
            $query = "SELECT * FROM users WHERE username = :username";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            SessionManager::setDataSession($data);
            return true;
        } else {
            return false;
        }
    }

    public static function logout()
    {
        SessionManager::closeSession();
        header('Location: login');
        exit();
    }
}
