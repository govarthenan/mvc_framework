<?php

/**
 * Core Class
 * Gets URL, and requires requested controller and calls the method along with arguments.
 *
 * @property string $currentController Controller from URL. Defaults to 'Pages'.
 * @property string $currentMethod Method from URL. Defaults to 'index'.
 * @property mixed[] $params Params specified in the URL. Defaults to none.
 *
 * @method mixed getURL() Returns the exploded URL content.
 */
class Core
{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    /**
     * Any suffix that comes after `localhost/traversymvc/` is considered as URL.
     * If suffix exists, get the URL. Trim it on both to remove `/`, whitespace and line break.
     * Sanitize, explode at `/` and returns an array.
     * If suffix is null, return null.
     *
     * @return string[]|null
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

        // if URL requests controller, update attribute and define file path
        // addition
        if (is_null($url)) {
            $requested_controller_path = APP_ROOT . '/controllers/' . $this->currentController . '.php';
        } else {
            $this->currentController = ucwords($url[0]);  // capitalize first char
            $requested_controller_path = APP_ROOT . '/controllers/' . $this->currentController . '.php';
        }

        // legacy
        // // get requested controller name and define file path
        // $requested_controller = ucwords($url[0]);  // capitalize first char
        // $requested_controller_path = APP_ROOT. '/controllers/' . $requested_controller . '.php';

        // if controller file exists, require and instantiate. unset that element since its not needed.
        if (file_exists($requested_controller_path)) {
            // require_once $requested_controller_path;
            $this->currentController = new $this->currentController;
            unset($url[0]);
        } else {  // addition
            // if controller file doens't exist, show 404
            echo '404';
            die();
        }

        // check if method was requested
        if (isset($url[1])) {
            // check if requested method exists
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];  // store requested method
                unset($url[1]);
            }

            // store params if any exist
            if (!empty($url)) {
                $this->params = array_values($url);
            }
        }

        // callback function that calls the requested/default method with params if any
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }
}
