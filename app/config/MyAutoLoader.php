<?php

/**
 * Class that encapsulates all autoloader functionalities.
 * The autoloader functions for each type of class is static, enabling execution without class instantiation.
 * @method void loadLibraries() Load classes found in `app/libraries/` e.g: Core, Controller, Model
 * @method void loadControllers() Load classses found in `app/controllers/` e.g: Pages, Posts
 * @method void loadModels() Load models found in `app/models`
 *
 * @param string $className The name of the class to be imported
 */
class MyAutoLoader
{
    public static function loadLibraries($className)
    {
        // define directory to search
        $target_dir = APP_ROOT . '/libraries';
        $class_path = $target_dir . '/' . $className . '.php';

        // if file exists, load file and log
        if (file_exists($class_path)) {
            require_once $class_path;
            $autoload_log[] = 'load - ' . $class_path;
        } else {
            $autoload_log[] = 'NOT load - ' . $class_path;
        }
    }

    public static function loadControllers($className)
    {
        // define directory to search
        $target_dir = APP_ROOT . '/controllers';
        $class_path = $target_dir . '/' . $className . '.php';

        // if file exists, load file and log
        if (file_exists($class_path)) {
            require_once $class_path;
            $autoload_log[] = 'load - ' . $class_path;
        } else {
            $autoload_log[] = 'NOT load - ' . $class_path;
        }
    }

    public static function loadModels($className)
    {
        // define directory to search
        $target_dir = APP_ROOT . '/models';
        $class_path = $target_dir . '/' . $className . '.php';

        // if file exists, load file and log
        if (file_exists($class_path)) {
            require_once $class_path;
            $autoload_log[] = 'load - ' . $class_path;
        } else {
            $autoload_log[] = 'NOT load - ' . $class_path;
        }
    }
}
