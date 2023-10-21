<?php
namespace App\Core\Functions;

/**
 * Class SessionManager
 *
 * A simple wrapper for handling PHP sessions.
 */
class SessionManager
{
    /**
     * SessionManager constructor.
     *
     * Starts the session.
     */
    // public function __construct()
    // {
    //     if (session_status() == PHP_SESSION_NONE) {
    //         session_start();
    //     }
    // }
    public function start(){
        session_start();
    }

    /**
     * Set a session variable.
     *
     * @param string $key   The session variable name.
     * @param mixed  $value The value to set.
     */
    public function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Get a session variable.
     *
     * @param string $key     The session variable name.
     * @param mixed  $default The default value to return if the variable is not set.
     *
     * @return mixed The session variable value or the default value if not set.
     */
    public function get(string $key, $default = null)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
    }

    /**
     * Check if a user is logged in (example method).
     *
     * @param string $key The session variable name for checking login status.
     * @return bool True if the user is logged in, false otherwise.
     */
    public function isLoggedIn(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Remove a session variable.
     *
     * @param string $key The session variable name to remove.
     */
    public function remove(string $key): void
    {
        unset($_SESSION[$key]);
    }

    /**
     * Destroy the session.
     */
    public function destroy(): void
    {
        session_destroy();
    }
}
