<?php

// /app/ folder path
define('APP_ROOT', dirname(__DIR__));

// site name
define('SITE_NAME', 'MVC');

// URL root
define('URL_ROOT', 'http://localhost/' . strtolower(SITE_NAME) . '/');

// import MyAutoLoader class and register static methods for autloading
require_once APP_ROOT . '/config/MyAutoLoader.php';  // class containing all autoload functions
spl_autoload_register('MyAutoLoader::loadLibraries');  // register static function's name as string
spl_autoload_register('MyAutoLoader::loadControllers');
spl_autoload_register('MyAutoLoader::loadModels');
