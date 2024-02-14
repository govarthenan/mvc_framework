<?php

/**
 * Controller class for Pages such as 'About Us' etc.
 */
class Pages
{
    public function __construct()
    {
        echo "Pages controller";
    }

    public function greet(string $target): void
    {
        echo "Hello, $target";
    }
}
