<?php

/**
 * Controller class for posts.
 */
class Posts extends Controller
{
    public function __construct()
    {
        echo "Posts controller";
    }

    public function index()
    {
        $this->loadView('test');
    }

    public function makePost(string $about): void
    {
        echo "Make post about, $about";
    }
}
