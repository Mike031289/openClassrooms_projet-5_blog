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
     * @param mixed $config      The application configuration.
     */
    public function __construct(object $httpRequest, mixed $config)
    {
        parent::__construct($httpRequest, $config);
    }
}
