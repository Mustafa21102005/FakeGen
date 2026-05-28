<?php

/** @var array<string, array<string>> $names */
$names = json_decode(file_get_contents('../data/names.json'), true);

/** @var array<string, array<string>> $emails */
$emails = json_decode(file_get_contents('../data/emails.json'), true);

/** @var array<string, array<string>> $phones */
$phones = json_decode(file_get_contents('../data/phones.json'), true);

if (!function_exists('getRandomFirstName')) {
    /**
     * Get a random first name from the provided names dataset.
     *
     * @param array<string, array<string>> $names
     * @return string
     */
    function getRandomFirstName(array $names): string
    {
        return $names['first_names'][array_rand($names['first_names'])];
    }
}

if (!function_exists('getRandomLastName')) {
    /**
     * Get a random last name from the provided names dataset.
     *
     * @param array<string, array<string>> $names
     * @return string
     */
    function getRandomLastName(array $names): string
    {
        return $names['last_names'][array_rand($names['last_names'])];
    }
}

if (!function_exists('getRandomName')) {
    /**
     * Generate a random full name using a random first and last name.
     *
     * Example output:
     * John Doe
     *
     * @param array<string, array<string>> $names
     * @return string
     */
    function getRandomName(array $names): string
    {
        return getRandomFirstName($names) . ' ' . getRandomLastName($names);
    }
}

if (!function_exists('getRandomEmail')) {
    /**
     * Generate a random email address using a random first name,
     * last name, and email domain.
     *
     * Example output:
     * john.doe@example.com
     *
     * @param array<string, array<string>> $names
     * @param array<string, array<string>> $emails
     * @return string
     */
    function getRandomEmail(array $names, array $emails): string
    {
        return strtolower(
            getRandomFirstName($names)
                . '.'
                . getRandomLastName($names)
                . '@'
                . $emails['emails'][array_rand($emails['emails'])]
        );
    }
}

if (!function_exists('getRandomPhoneNumber')) {
    /**
     * Generate a random international phone number.
     *
     * The generated number consists of:
     * - A random country code from the provided dataset
     * - A randomly generated 9-digit subscriber number
     *
     * Example output:
     * +966 512345678
     *
     * @param array<int, string> $phones
     * @return string
     */
    function getRandomPhoneNumber(array $phones): string
    {
        return '+' . $phones[array_rand($phones)] . ' ' . mt_rand(100000000, 999999999);
    }
}
