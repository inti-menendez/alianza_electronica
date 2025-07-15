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
        if (!file_exists($viewPath)){
            http_response_code(404);
            echo "View not found: " . htmlspecialchars($view);
            return;
        }
        include __DIR__ . '/../../public/resources/layout/base.php';
    }
}
