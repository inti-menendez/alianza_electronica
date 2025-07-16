<?php

class CustomerController extends controller
{
    public static function index()
    {
        SessionManager::requireLogin(); 

        self::render(__DIR__ . '/views/customerView.php');
    }


}