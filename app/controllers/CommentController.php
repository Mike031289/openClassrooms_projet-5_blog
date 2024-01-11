<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\HttpRequest;

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
     * @param HttpRequest $httpRequest the HTTP request object
     * @param object $config      the application configuration object (JSON decode Object)
     */
    public function __construct(HttpRequest $httpRequest, object $config)
    {
        parent::__construct($httpRequest, $config);
    }
}
