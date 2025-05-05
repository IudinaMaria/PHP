<?php

/**
 * @param array $errors An associative array of error messages.
 * @param string $key The key to look for in the errors array.
 * @return string The formatted error message as an HTML string or an empty string if the key is not found.
 */
function getError(array $errors, string $key): string
{
    return $errors[$key] ?? ''
        ? "<p class='text-red-500 text-sm mt-1'>{$errors[$key]}</p>"
        : '';
}