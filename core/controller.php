<?php

class controller
{
    public static function render($viewPath, $data=[])
    {
        extract($data);

        if (!file_exists($viewPath)) {
            $viewPath = ERROR_CODES_DIR . '/404.php';
        }
        include __DIR__ . '/../public/resources/layout/base.php';
    }
}
