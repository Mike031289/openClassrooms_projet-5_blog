<?php

declare(strict_types=1);

namespace App\Core\Functions;

class FormHelper
{
    // Regex patterns for form field validation
    public const USERNAME_REGEX = '/^[a-zA-Z0-9_-]{3,20}$/'; // Example pattern for username
    public const EMAIL_REGEX = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/'; // Example pattern for email
    public const TEXTAREA_REGEX = '/^.{5,}$/s'; // Example pattern for textarea
    public const PASSWORD_REGEX = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/'; // Example pattern for password (at least 8 characters, including at least one digit, one lowercase, and one uppercase letter)

    /**
     * Get a value from the $_POST superglobal.
     *
     * @param  string $key     the key to retrieve
     * @param  mixed  $default the default value to return if the key does not exist
     * @return mixed  the value associated with the key or the default value
     */
    public static function post(string $key, mixed $default = null, array $source = null): mixed
    {
        $source = $source ?? $_POST;

        return $source[$key] ?? $default;
    }

    /**
     * Get a value from the $_GET superglobal.
     *
     * @param  string $key     the key to retrieve
     * @param  mixed  $default the default value to return if the key does not exist
     * @return mixed  the value associated with the key or the default value
     */
    public static function get(string $key, mixed $default = null, array $source = null): mixed
    {
        $source = $source ?? $_GET;

        return $source[$key] ?? $default;
    }

    /**
     * Get a value from the $_FILES superglobal.
     *
     * @param  string $key     the key to retrieve
     * @param  mixed  $default the default value to return if the key does not exist
     * @return mixed  the value associated with the key or the default value
     */
    public static function files(string $key, mixed $default = null, array $source = null): mixed
    {
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
