<?php
class PostData {
    private $data;

    public function __construct() {
        $this->data = $_POST;
    }

    public function get($key, $default = null) {
        return isset($this->data[$key]) ? $this->data[$key] : $default;
    }

    public function set($key, $value) {
        $this->data[$key] = $value;
    }

    public function remove($key) {
        unset($this->data[$key]);
    }
}
// // Instanciation de la classe PostData
// $postData = new PostData();

// // Récupération des données POST
// $username = $postData->get('username');
// $password = $postData->get('password');

// // Modification des données POST
// $postData->set('new_key', 'new_value');

// // Suppression d'une clé dans les données POST
// $postData->remove('username');