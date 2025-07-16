<?php

class DashboardController extends controller
{
    public function index()
    {
        SessionManager::requireLogin(); 

        self::render(__DIR__ . '/views/' . 'home.php');

    }


}
