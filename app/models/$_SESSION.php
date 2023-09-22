<?php
class SessionWrapper {
    public function __construct() {
        session_start();
    }

    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public function get($key, $default = null) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
    }

    public function remove($key) {
        unset($_SESSION[$key]);
    }

    public function destroy() {
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
