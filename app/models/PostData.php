<?php
namespace App\Models;

class PostData
{

    public function __construct()
    {
    }

    /**
     * Get a POST value by its key.
     *
     * @param string $key The key of the POST value.
     * The default value to return if the key does not exist.
     * The POST value associated with the key or the default value.
     */
    public function get(string $key, mixed $default = null)
    {
        return isset($_POST[$key]) ? $_POST[$key] : $default;
    }

    /**
     * Set a POST value.
     *
     * @param string $key The key of the POST value.
     * The value to set.
     */
    public function set(string $key, $value):void
    {
        $_POST[$key] = $value;
    }

    /**
     * Remove a POST value by its key.
     *
     * @param string $key The key of the POST value to remove.
     */
    public function remove(string $key): void
    {
        unset($_POST[$key]);
    }
}
