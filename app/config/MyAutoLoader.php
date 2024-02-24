<?php

/**
 * Class that encapsulates all autoloader functionalities.
 * The autoloader functions for each type of class is static, enabling execution without class instantiation.
 * @method void loadLibraries() Load classes found in `app/libraries/` e.g: Core, Controller, Model
 * @method void loadControllers() Load classses found in `app/controllers/` e.g: Pages, Posts
 * @method void loadModels() Load models found in `app/models`
 * @method void consoleLog() Log to JS console regarding autoload activities.
 *
 * @param string $className The name of the class to be imported
 */
class MyAutoLoader
{

    /**
     * Log to JS console about each autload method that is run.
     *
     * @param boolean $loadStatus Indicates whether the method loaded a class or not.
     * @param string $classPath The file path of the class that was passed in.
     * @param string $loaderMethod The specific method the log entry is about.
     */
    public static function consoleLog(int $loadStatus, string $classPath, string $loaderMethod)
    {
        if ($loadStatus == true) {
            $console_message = 'load - ' . $classPath . ' - ' . $loaderMethod;
        } else {
            $console_message = 'NOT load - ' . $classPath . ' - ' . $loaderMethod;
        }
        echo "<script type=\"text/javascript\">console.log(\"$console_message\")</script>\n";
    }

    public static function loadLibraries($className)
    {
        // define directory to search
        $target_dir = APP_ROOT . '/libraries';
        $class_path = $target_dir . '/' . $className . '.php';

        // if file exists, load file and log
        if (file_exists($class_path)) {
            require_once $class_path;
            self::consoleLog(true, $class_path, __FUNCTION__);
        } else {
            self::consoleLog(false, $class_path, __FUNCTION__);
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
            self::consoleLog(true, $class_path, __FUNCTION__);
        } else {
            self::consoleLog(false, $class_path, __FUNCTION__);
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
            self::consoleLog(true, $class_path, __FUNCTION__);
        } else {
            self::consoleLog(false, $class_path, __FUNCTION__);
        }
    }
}
