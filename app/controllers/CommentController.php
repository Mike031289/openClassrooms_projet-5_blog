<?php
namespace App\Controllers;

use App\Manager\PostManager;
use App\Core\Functions\FormHelper;

/**
 * Class CommentController
 *
 * Controller responsible for handling comments-related actions.
 */
class CommentController extends BaseController
{
    /**
     * CommentController constructor.
     *
     * @param object $httpRequest The HTTP request object.
     * @param object  $config      The application configuration object (JSON decode Object).
     */
    public function __construct(object $httpRequest, object $config)
    {
        parent::__construct($httpRequest, $config);
    }

    public function addComment(): void
    {
        // Check if the user is logged in and pass the user information to the template
        $user = $this->session->getUser();

        // Retrieve data from the form
        $content = htmlspecialchars(FormHelper::post('content'));

    }

}
