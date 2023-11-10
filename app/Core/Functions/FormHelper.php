<?php
namespace App\Core\Functions;

class FormHelper
{
  // Regex patterns for form field validation
  const USERNAME_REGEX = '/^[a-zA-Z0-9_-]{3,20}$/'; // Example pattern for username
  const EMAIL_REGEX    = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/'; // Example pattern for email
  const PASSWORD_REGEX = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/'; // Example pattern for password (at least 8 characters, including at least one digit, one lowercase, and one uppercase letter)

  /**
   * Get a value from the $_POST superglobal.
   *
   * @param $key The key to retrieve.
   * @param $default The default value to return if the key does not exist.
   * @return, the value associated with the key or the default value.
   */
  public static function post(string $key, mixed $default = null): mixed
  {
    return isset($_POST[$key]) ? $_POST[$key] : $default;
  }

  /**
   * Get a value from the $_GET superglobal.
   *
   * @param $key The key to retrieve.
   * @param $default The default value to return if the key does not exist.
   * @return, the value associated with the key or the default value.
   */
  public static function get(string $key, mixed $default = null): mixed
  {
    return isset($_GET[$key]) ? $_GET[$key] : $default;
  }

  /**
   * Get a value from the $_FILES superglobal.
   *
   * @param string $key The key to retrieve.
   * @param mixed $default The default value to return if the key does not exist.
   * @return mixed The value associated with the key or the default value.
   */
  public static function files(string $key, mixed $default = null): mixed
  {
    return isset($_FILES[$key]) ? $_FILES[$key] : $default;
  }


  /**
   * Validate a field using a regular expression pattern.
   *
   * @param $field The field value to validate.
   * @param $regex The regular expression pattern to use for validation.
   * @return, true if the field is valid, false otherwise.
   */
  public static function validateField(string $field, string $regex): bool
  {
    return (bool) preg_match($regex, $field);
  }
}