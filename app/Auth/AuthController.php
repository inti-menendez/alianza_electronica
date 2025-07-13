<?php

class AuthController
{
    public static function index()
    {
        require_once 'views/loginView.php';
    }

    public static function auth()
    {
        header('Content-Type: application/json');
        $response = ['success' => false, 'message' => 'Credenciales incorrectas'];


        $db = new db();
        $authService = new AuthService($db->connect());
        if ($authService->authenticate(Request::input('username'), Request::input('password'))) {
            $response['success'] = true;
            $response['message'] = 'Login exitoso';
            ob_clean(); // Limpia cualquier salida previa inesperada
            echo json_encode($response);
            exit();
        } else {
            ob_clean(); // Limpia cualquier salida previa inesperada
            echo json_encode($response);
            exit();
        }
    }
}
