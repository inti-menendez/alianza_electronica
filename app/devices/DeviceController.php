<?php

class DeviceController extends controller
{
    public static function index()
    {
        SessionManager::requireLogin();

        self::render(__DIR__ . '/views/deviceView.php');
    }
}