<?php

/**
 * Controller class for Pages such as 'About Us' etc.
 */
class Pages extends Controller
{
    public function __construct()
    {
        echo "Pages controller";
    }

    public function index()
    {
        $this->loadView('test');
    }

    public function greet(string $target): void
    {
        echo "Hello, $target";
    }
}
