<?php

class DashboardController
{
    public function index()
    {
        if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
            header('Location: login');
            exit();
        }

        self::render();
    }
    public static function render()
    {
        // Verifica que el usuario esté autenticado
        // SessionManager::requireLogin(); //idea futura TODO: usar SessionManager para manejar sesiones

         if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
            header('Location: login');
            exit();
        }

        $viewPath = __DIR__ . '/views/home.php';

        // Incluye el layout base que arma toda la página
        include __DIR__ . '/../../public/resources/layout/base.php';
    }
}
