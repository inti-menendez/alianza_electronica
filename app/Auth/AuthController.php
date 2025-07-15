<?php

class AuthController
{
    public static function index()
    {
        if (isset($_SESSION['logged_in']) || $_SESSION['logged_in']) {
            header('Location: home');
            exit();
        }
        require_once 'views/loginView.php';
    }

    public static function auth()
    {
        header('Content-Type: application/json');
        $response = ['success' => false, 'message' => 'Credenciales incorrectas'];


        $db = new db();
        $authService = new AuthService($db->connect());
        $request = new Request();
        
        if ($authService->authenticate($request->input('username'), $request->input('password'))) {
            $response['success'] = true;
            $response['message'] = 'Login exitoso';
            ob_clean();
            echo json_encode($response);
            exit();
        } else {
            ob_clean();
            echo json_encode($response);
            exit();
        }
    }
}
