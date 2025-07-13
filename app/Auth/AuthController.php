<?php

class AuthController
{
    public static function index()
    {
        require_once 'views/loginView.php';
    }

    public static function auth()
    {
        $db = new db();
        $authService = new AuthService($db->connect());
        if ($authService->authenticate(Request::input('username'), Request::input('password'))) {
            header('Location: /home');
            exit();
        } else {
            echo json_encode(['error' => 'Credenciales Inválidas']);
            exit();
        }
    }
}
