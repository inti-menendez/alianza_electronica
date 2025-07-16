<?php

class SessionManager
{
    public static function requireLogin()
    {
        if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
            header('Location: login');
            exit();
        }
    }

    public static function closeSession()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        session_unset();
        session_destroy();
    }

    public static function isLoggedIn()
    {
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'];
    }

    public static function setDataSession($data)
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['logged_in'] = true;
        $_SESSION['user'] = $data;
    }
}
