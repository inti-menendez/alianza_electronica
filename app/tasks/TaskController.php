<?php

class TaskController extends controller
{
    public static function index()
    {
        SessionManager::requireLogin();
        self::render(__DIR__ . '/views/taskView.php');
    }
}