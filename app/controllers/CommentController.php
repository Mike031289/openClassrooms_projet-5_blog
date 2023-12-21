<?php

declare(strict_types=1);

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
     * @param object $httpRequest the HTTP request object
     * @param object $config      the application configuration object (JSON decode Object)
     */
    public function __construct(object $httpRequest, object $config)
    {
        parent::__construct($httpRequest, $config);
    }
}
