<?php

declare(strict_types=1);

if (!function_exists('getRandomUser')) {
    /**
     * Generate a fake user object.
     *
     * Creates a realistic fake user by combining multiple generators into
     * a single associative array. The returned user contains a random name,
     * email address, phone number, password, and favorite color.
     *
     * @param array{
     *     first_names: array<int, string>,
     *     last_names: array<int, string>
     * } $names Collection of first and last names.
     * @param array<int, string> $emails Collection of email domains.
     * @param array<int, string> $phones Collection of phone prefixes.
     * @param int $passwordLength Length of the generated password.
     * @param bool $uppercase Whether uppercase letters are allowed.
     * @param bool $lowercase Whether lowercase letters are allowed.
     * @param bool $numbers Whether numeric digits are allowed.
     * @param bool $symbols Whether symbols are allowed.
     *
     * @return array{
     *     name: string,
     *     email: string,
     *     phone: string,
     *     password: string,
     *     favorite_color: array{
     *         hex: string,
     *         rgb: string,
     *         hsl: string
     *     }
     * }
     *
     * @throws InvalidArgumentException If the password configuration is invalid.
     */
    function getRandomUser(
        array $names,
        array $emails,
        array $phones,
        int $passwordLength = 16,
        bool $uppercase = true,
        bool $lowercase = true,
        bool $numbers = true,
        bool $symbols = true
    ): array {
        $name = getRandomName($names);

        return [
            'name' => $name,
            'email' => getRandomEmailFromName($name, $emails),
            'phone' => getRandomPhoneNumber($phones),
            'password' => getRandomPassword(
                $passwordLength,
                $uppercase,
                $lowercase,
                $numbers,
                $symbols
            ),
            'favorite_color' => getRandomColor(),
        ];
    }
}
