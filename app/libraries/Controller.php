<?php

/**
 * Parent class for all controllers
 * Loads models and views for other users/controllers
 */
class Controller
{
    /**
     * Load database model file.
     *
     * @param string $model Name of database model file in `/app/models/`
     */
    public function loadModel(string $model)
    {
        // define file path
        $model_path = APP_ROOT . '/models/' . $model . '.php';

        // check if file exists
        if (file_exists($model_path)) {
            require_once $model_path;  // ToDo: Safely remove this block after ensuring autoload works.
        } else {
            die("\nModel $model not found\n");  // ToDo: improve error handling
        }
    }

    /**
     * Load view file.
     *
     * @param string $view Name of view files in `/app/views/`
     * @param array $data Associative array of variable data for the view.
     */
    public function loadView(string $view, array $data = [])
    {
        // define file path
        $view_path = APP_ROOT . '/views/' . $view . '.php';

        // check file availability & load
        if (file_exists($view_path)) {
            require_once $view_path;
        } else {
            die("\nView $view not found\n");  // ToDo: improve error handling
        }
    }
}
