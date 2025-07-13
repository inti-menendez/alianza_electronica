<?php

class Autoloader {

    public static function register() {
        if (function_exists('__autoload')) {
            spl_autoload_register('__autoload');
            return;
        }

        if (version_compare(PHP_VERSION, '5.3.0') >= 0) {
            spl_autoload_register(array('Autoloader', 'charge'), true, true);
        } else {
            spl_autoload_register(array('Autoloader', 'charge'));
        }
    }

    public static function charge($clase) {
        $fileName = $clase . '.php';
        $folders = require PATH_CONFIG . 'autoloader.php';
        foreach ($folders as $folder) {
            if (self::searchFile($folder, $fileName)) {
                return true;
            }
        }
        return false;
    }

    private static function searchFile($folder, $fileName) {
        $files = scandir($folder);
        foreach ($files as $file) {
            $filePath = realpath($folder . DIRECTORY_SEPARATOR . $file);
            if (is_file($filePath)) {
                if ($fileName == $file) {
                    require_once $filePath;
                    return true;
                }
            } else if ($file != '.' && $file != '..') {
                self::searchFile($filePath, $fileName);
            }
        }
        return false;
    }

}
