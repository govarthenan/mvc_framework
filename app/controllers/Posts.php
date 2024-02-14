<?php
/**
 * Controller class for posts.
 */
class Posts
{
    public function __construct()
    {
        echo "Posts controller";
    }

    public function makePost(string $about): void
    {
        echo "Make post about, $about";
    }
}
