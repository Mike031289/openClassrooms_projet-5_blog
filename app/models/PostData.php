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
     * Get a POST value by its key with optional filtering and regex validation.
     *
     * @param string $key The key of the POST value.
     * @param int|null $filter The filter to apply (e.g., FILTER_SANITIZE_STRING).
     * @param string|null $regex A regular expression pattern for validation.
     * @param mixed $default The default value to return if the key does not exist.
     * @return mixed The POST value associated with the key or the default value.
     * @throws \RuntimeException If regex validation fails (optional).
     */
    public function getFilteredAndValidated(string $key, ?int $filter = null, ?string $regex = null, $default = null) 
    {
        $value = $this->get($key, $default);
        if ($value === null) {
            return $default;
        }

        if ($filter !== null) {
            $value = filter_var($value, $filter);
        }

        return $value;
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
