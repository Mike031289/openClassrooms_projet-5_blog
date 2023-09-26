<?php
namespace App\Controllers;

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
}
