<?php

class controller
{
    public static function render($viewPath)
    {
        if (!file_exists($viewPath)) {
            $viewPath = ERROR_CODES_DIR . '/404.php';
        }
        include __DIR__ . '/../public/resources/layout/base.php';
    }
}
