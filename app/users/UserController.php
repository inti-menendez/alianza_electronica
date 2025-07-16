<?php

class UserController extends controller
{
    public static function index()
    {
        SessionManager::requireLogin();

        self::render(__DIR__ . '/views/userView.php');
    }
}