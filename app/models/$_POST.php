<?php
class PostData
{
    /**
     * @var array The POST data.
     */
    private array $data;

    /**
     * Constructor for the class.
     */
    public function __construct()
    {
        $this->data = $_POST;
    }

    /**
     * Get a POST value by its key.
     *
     * @param string $key The key of the POST value.
     * @param mixed $default The default value to return if the key does not exist.
     * @return mixed The POST value associated with the key or the default value.
     */
    public function get(string $key, mixed $default = null): mixed
    {
        return isset($this->data[$key]) ? $this->data[$key] : $default;
    }

    /**
     * Set a POST value.
     *
     * @param string $key The key of the POST value.
     * @param mixed $value The value to set.
     */
    public function set(string $key, mixed $value):void
    {
        $this->data[$key] = $value;
    }

    /**
     * Remove a POST value by its key.
     *
     * @param string $key The key of the POST value to remove.
     */
    public function remove(string $key): void
    {
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