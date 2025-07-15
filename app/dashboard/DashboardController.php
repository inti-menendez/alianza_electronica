<?php

class DashboardController
{
    public function index()
    {
        SessionManager::requireLogin(); 

        self::render();
    }
    public static function render($view = 'home')
    {
        $viewPath = __DIR__ . '/views/'.$view.'.php';

        // Incluye el layout base que arma toda la página
        include __DIR__ . '/../../public/resources/layout/base.php';
    }
}
