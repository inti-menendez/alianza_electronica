<?php 

class AuthService {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function authenticate($username, $password) {
        
        $query = "SELECT * FROM users WHERE username = :username AND password_hash = :password";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            $this->setDataSession();
            return true;
        } else {
            return false;
        }
    }

    public function setDataSession() {

        if (!isset($_SESSION)) {
            session_start();
        }

        $query = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->db->prepare($query); 
        $stmt->bindParam(':username', Request::input('username'));
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $data['username'];
        $_SESSION['role'] = $data['role'];
        $_SESSION['name'] = $data['name'];
        $_SESSION['last_login'] = $data['last_login'];
        $_SESSION['id'] = $data['id'];
        $_SESSION['dni'] = $data['dni'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['phone'] = $data['phone'];
        $_SESSION['created_at'] = $data['created_at'];
        $_SESSION['updated_at'] = $data['updated_at'];
        $_SESSION['status'] = $data['status'];
    }

    public function logout() {
        if (!isset($_SESSION)) {
            session_start();
        }

        session_unset();
        session_destroy();
        
        header('Location: /login');
        exit();
    }
}