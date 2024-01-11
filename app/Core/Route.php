<?php

namespace App\Core;

use App\Exceptions\ActionNotFoundException;
use App\Exceptions\ControllerNotFoundException;

/**
 * Class Route
 *
 * Represents a route in your application for routing HTTP requests to controllers and actions.
 */
class Route
{
    private string $_path;
    private string $_controller;
    private ?string $_action;
    private string $_method;
    private mixed $_param;
    private mixed $_managers;

    /**
     * Route constructor.
     *
     * @param object $route       the route object containing route information
     * @param array<mixed>  $routeParams the route parameters
     */
    public function __construct(object $route, array $routeParams)
    {
        // Check if the required properties exist in $route
        if (!property_exists($route, 'path') || !property_exists($route, 'controller') || !property_exists($route, 'action') || !property_exists($route, 'method') || !property_exists($route, 'managers')) {
            throw new ActionNotFoundException();
        }

        $this->_path       = $route->path;
        $this->_controller = $route->controller;
        $this->_action     = $route->action;
        $this->_method     = $route->method;
        $this->_param      = $routeParams;
        $this->_managers   = $route->managers;
    }

    /**
     * Get the value of _path.
     */
    public function getPath(): string
    {
        return $this->_path;
    }

    /**
     * Get the value of _controller.
     */
    public function getController(): string
    {
        return $this->_controller;
    }

    /**
     * Get the value of _action.
     */
    public function getAction(): ?string
    {
        return $this->_action;
    }

    /**
     * Get the value of _method.
     * @return string $_method
     */
    public function getMethod(): string
    {
        return $this->_method;
    }

    /**
     * Get the value of _param.
     * @return array<mixed>  $_param
     */
    public function getParam(): array
    {
        return $this->_param;
    }

    /**
     * Get the value of _managers.
     * @return array<mixed>  $_managers
     */
    public function getManagers(): array
    {
        return $this->_managers;
    }

    /**
     * Run the route and execute the associated controller action.
     *
     * @param object $httpRequest the HTTP request object
     * @param object $config      the application configuration
     *
     * @throws ActionNotFoundException     if the action does not exist in the controller
     * @throws ControllerNotFoundException if the controller class does not exist
     */
    public function run(object $httpRequest, object $config): void
    {
        $controller     = null;
        $controllerName = $this->_controller;

        // Check if the controller class exists
        if (class_exists($controllerName)) {
            $controller = new $controllerName($httpRequest, $config);

            // Check if the method (action) exists in the controller
            if (method_exists($controller, $this->_action)) {
                $params = array_values($this->_param);

                // Call the controller's action with the appropriate parameters
                $controller->{$this->_action}(...$params);
            } else {
                throw new ActionNotFoundException();
            }
        } else {
            throw new ControllerNotFoundException();
        }
    }
}