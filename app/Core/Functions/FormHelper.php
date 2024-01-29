<?php

declare(strict_types=1);

namespace App\Core\Functions;

class FormHelper
{
    // Regex patterns for form field validation
    public const USERNAME_REGEX = '/^[a-zA-Z0-9_-]{3,20}$/'; // Example pattern for username
    public const EMAIL_REGEX    = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/'; // Example pattern for email
    public const TEXTAREA_REGEX = '/^.{5,}$/s'; // Example pattern for textarea
    public const PASSWORD_REGEX = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/'; // Example pattern for password (at least 8 characters, including at least one digit, one lowercase, and one uppercase letter)

    /**
     * Get a value from the specified data source or from the $_POST superglobal if not provided.
     *
     * @param string $key     The key to retrieve
     * @param $default The default value to return if the key does not exist
     * @param array $source The data source to retrieve the value from (default is $_POST)
     * @return string The value associated with the key or the default value
     */
    public static function post(string $key, $default = null , $source = null ): string
    {
        // If $source is not provided, use $_POST as the default source
        $source = $source ?? $_POST;

        return $source[$key] ?? $default;
    }

    /**
     * Get a value from the specified data source or from the $_GET superglobal if not provided.
     *
     * @param string $key     The key to retrieve
     * @param mixed  $default The default value to return if the key does not exist
     * @param array<mixed> $source The data source to retrieve the value from (default is $_GET)
     * @return mixed The value associated with the key or the default value
     */
    public static function get(string $key, mixed $default = null, array $source = null): mixed
    {
        // If $source is not provided, use $_GET as the default source
        $source = $source ?? $_GET;

        return $source[$key] ?? $default;
    }

    /**
     * Get a value from the specified data source or from the $_FILES superglobal if not provided.
     *
     * @param string $key     The key to retrieve
     * @param mixed  $default The default value to return if the key does not exist
     * @param array<mixed> $source The data source to retrieve the value from (default is $_FILES)
     * @return mixed The value associated with the key or the default value
     */
    public static function files(string $key, mixed $default = null, array $source = null): mixed
    {
        // If $source is not provided, use $_FILES as the default source
        $source = $source ?? $_FILES;

        return $source[$key] ?? $default;
    }

    /**
     * Validate a field using a regular expression pattern.
     *
     * @param string $field The field value to validate
     * @param string $regex The regular expression pattern to use for validation
     * @return bool true if the field is valid, false otherwise.
     */
    public static function validateField(string $field, string $regex): bool
    {
        return (bool) preg_match($regex, $field);
    }
    
}
