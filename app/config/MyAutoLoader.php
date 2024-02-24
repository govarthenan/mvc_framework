<?php

/**
 * Class that encapsulates all autoloader functionalities.
 * The autoloader functions for each type of class is static, enabling execution without class instantiation.
 * @method void masterAutoLoad() Other methods call this one to import classes found in their target directories.
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

    /**
     * Master autoload method. All other autoload methods call this method.
     * This method gets a target directory, class file's name and the specific delegate method's name (for logging).
     * And then the given class is imported from the target directory.
     *
     * @param string $targetDir Directory to construct the path to `require_once`.
     * @param string $className The class file to import.
     * @param string $specificAutoLoaderName The name of the delegate method which called the master auto load function.
     */
    public static function masterAutoLoad(string $targetDir, string $className, string $specificAutoLoaderName)
    {
        // construct the file path to target class
        $class_path = $targetDir . '/' . $className . '.php';

        // if file exists, load file and log
        if (file_exists($class_path)) {
            require_once $class_path;
            self::consoleLog(true, $class_path, $specificAutoLoaderName);
        } else {
            self::consoleLog(false, $class_path, $specificAutoLoaderName);
        }
    }

    public static function loadLibraries($className)
    {
        // define directory to search
        $target_dir = APP_ROOT . '/libraries';

        // call master autoload function
        self::masterAutoLoad($target_dir, $className, __FUNCTION__);
    }

    public static function loadControllers($className)
    {
        // define directory to search
        $target_dir = APP_ROOT . '/controllers';

        // call master autoload function
        self::masterAutoLoad($target_dir, $className, __FUNCTION__);
    }

    public static function loadModels($className)
    {
        // define directory to search
        $target_dir = APP_ROOT . '/models';

        // call master autoload function
        self::masterAutoLoad($target_dir, $className, __FUNCTION__);
    }
}
