<?php

// Database parameters
define('DB_HOST', 'database');
define('DB_USER', 'root');
define('DB_PASSWORD', 'tiger');
define('DB_NAME', 'mvcDB');

// /app/ folder path
define('APP_ROOT', dirname(__DIR__));

// site name
define('SITE_NAME', 'MVC');

// URL root
define('URL_ROOT', 'http://localhost/' . strtolower(SITE_NAME));

// import MyAutoLoader class and register static methods for autloading
spl_autoload_register('MyAutoLoader::autoLoadLibraries');  // register static function's name as string
spl_autoload_register('MyAutoLoader::autoLoadControllers');
spl_autoload_register('MyAutoLoader::autoLoadModels');
