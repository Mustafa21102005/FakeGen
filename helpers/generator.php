<?php

declare(strict_types=1);

if (!function_exists('generate')) {
    /**
     * Generate fake data of the requested type.
     *
     * @param string $type Data type to generate.
     * @param int $quantity Number of items to generate.
     * @param int $passwordLength Password length when generating passwords.
     * @param bool $uppercase Include uppercase letters.
     * @param bool $lowercase Include lowercase letters.
     * @param bool $numbers Include numeric digits.
     * @param bool $symbols Include symbols.
     *
     * @return array<int, string|array<string, string>>
     *
     * @throws InvalidArgumentException
     */
    function generate(
        string $type,
        int $quantity,
        int $passwordLength = 16,
        bool $uppercase = true,
        bool $lowercase = true,
        bool $numbers = true,
        bool $symbols = true
    ): array {

        global $names, $emails, $phones;

        $generators = [
            'color' => fn() => getRandomColor(),
            'email' => fn() => getRandomEmail($names, $emails),
            'name' => fn() => getRandomName($names),
            'password' => fn() => getRandomPassword(
                $passwordLength,
                $uppercase,
                $lowercase,
                $numbers,
                $symbols
            ),
            'phone' => fn() => getRandomPhoneNumber($phones),
        ];

        if (!array_key_exists($type, $generators)) {
            throw new InvalidArgumentException('Invalid type.');
        }

        if ($quantity < 1 || $quantity > 10000) {
            throw new InvalidArgumentException('Invalid quantity.');
        }

        if ($type === 'password' && ($passwordLength < 4 || $passwordLength > 256)) {
            throw new InvalidArgumentException('Invalid password length.');
        }

        $result = [];

        for ($i = 0; $i < $quantity; $i++) {
            $result[] = $generators[$type]();
        }

        return $result;
    }
}
