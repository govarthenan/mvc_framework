<?php

class Core
{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    /**
     * @return false|string[]|null
     */
    public function getURL()
    {
        if (isset($_GET['url'])) {
            $url = trim($_GET['url'], "/ \n\r\t\v\0");
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        } else {
            return null;
        }
    }

    public function __construct()
    {
        // get sanitized, exploded URL array
        $url = $this->getURL();

        // get requested controller name and define file path
        $requested_controller = ucwords($url[0]);  // capitalize first char
        $requested_controller_path = '../app/controllers/' . $requested_controller . '.php';

        // if controller file exists, require and instantiate. unset that element since its not needed.
        if (file_exists($requested_controller_path)) {
            require_once $requested_controller_path;
            $currentController = new $requested_controller;
            unset($url[0]);
        }
    }
}
