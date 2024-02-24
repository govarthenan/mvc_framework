<?php

/**
 * Controller class for posts.
 *
 * @property mixed $postModel An instance of `Post` model.
 */
class Posts extends Controller
{
    private $postModel;
    public function __construct()
    {
        echo "Posts controller";

        // load Post model
        $this->postModel = $this->loadModel('Post');  // load DB model 'Post'. PDO instance is inside private property
    }

    public function index()
    {
        $employee_data = $this->postModel->getEmployees();  // get employee data from the model
        $this->loadView('posts/index', ['posts' => $employee_data]);  // load view with employee data
    }

    public function makePost(string $about): void
    {
        echo "Make post about, $about";
    }
}
