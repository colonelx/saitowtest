<?php

namespace Saitow\Middleware;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

/**
 * Class SessionMiddleware
 * Required to start a session on application start
 * @package Saitow\Middleware
 */
class SessionMiddleware
{
    /**
     * @param Request $request
     * @param Response $response
     * @param callable $next
     * @return callable Continue with the Request handling
     */
    public function __invoke(Request $request, Response $response, callable $next)
    {
        $this->startSession();
        return $next($request, $response);
    }

    /**
     * session_start()
     */
    protected function startSession()
    {
        session_name('saitow_session');
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
}
