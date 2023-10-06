<?php
namespace App\Core\Functions;

/**
 * Class SessionWrapper
 *
 * A simple wrapper for handling PHP sessions.
 */
class SessionManager
{
    /**
     * SessionWrapper constructor.
     *
     * Starts the session.
     */
    public function __construct()
    {
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
     * Remove a session variable.
     *
     * @param string $key The session variable name to remove.
     */
    public function isLoggegIn(string $key): void
    {
        isset($_SESSION[$key]);
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

// // Instanciation de la classe SessionWrapper
// $session = new SessionWrapper();

// // Définition d'une variable de session
// $session->set('user_id', 123);

// // Récupération de la variable de session
// $user_id = $session->get('user_id');

// // Suppression de la variable de session
// $session->remove('user_id');

// // Destruction de la session
// $session->destroy();
