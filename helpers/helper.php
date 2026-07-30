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
        return '+' . $phones[array_rand($phones)] . ' ' . random_int(100000000, 999999999);
    }
}

if (!function_exists('getRandomRgb')) {
    /**
     * Generate a random RGB color.
     *
     * Each color channel (red, green, and blue) is randomly
     * generated with a value between 0 and 255.
     *
     * Example output:
     * [
     *     'r' => 47,
     *     'g' => 152,
     *     'b' => 212
     * ]
     *
     * @return array{r:int,g:int,b:int}
     */
    function getRandomRgb(): array
    {
        return [
            'r' => random_int(0, 255),
            'g' => random_int(0, 255),
            'b' => random_int(0, 255),
        ];
    }
}

if (!function_exists('rgbToHex')) {
    /**
     * Convert an RGB color to its hexadecimal representation.
     *
     * Example output:
     * #2F98D4
     *
     * @param array{r:int,g:int,b:int} $rgb RGB color values.
     * @return string
     */
    function rgbToHex(array $rgb): string
    {
        return sprintf(
            '#%02X%02X%02X',
            $rgb['r'],
            $rgb['g'],
            $rgb['b']
        );
    }
}

if (!function_exists('rgbToCss')) {
    /**
     * Convert an RGB color to a CSS rgb() color string.
     *
     * Example output:
     * rgb(47,152,212)
     *
     * @param array{r:int,g:int,b:int} $rgb RGB color values.
     * @return string
     */
    function rgbToCss(array $rgb): string
    {
        return sprintf(
            'rgb(%d,%d,%d)',
            $rgb['r'],
            $rgb['g'],
            $rgb['b']
        );
    }
}

if (!function_exists('rgbToHsl')) {
    /**
     * Convert RGB values to a CSS hsl() color string.
     *
     * The input RGB values are expected to be integers between 0 and 255.
     *
     * Example output:
     * hsl(201,64%,51%)
     *
     * @param array{r:int,g:int,b:int} $rgb
     * @return string
     */
    function rgbToHsl(array $rgb): string
    {
        $r = $rgb['r'] / 255;
        $g = $rgb['g'] / 255;
        $b = $rgb['b'] / 255;

        $max = max($r, $g, $b);
        $min = min($r, $g, $b);

        $h = 0;
        $s = 0;
        $l = ($max + $min) / 2;

        if ($max !== $min) {
            $delta = $max - $min;

            $s = $l > 0.5
                ? $delta / (2 - $max - $min)
                : $delta / ($max + $min);

            switch ($max) {
                case $r:
                    $h = (($g - $b) / $delta) + ($g < $b ? 6 : 0);
                    break;

                case $g:
                    $h = (($b - $r) / $delta) + 2;
                    break;

                case $b:
                    $h = (($r - $g) / $delta) + 4;
                    break;
            }

            $h /= 6;
        }

        return sprintf(
            'hsl(%d,%d%%,%d%%)',
            round($h * 360),
            round($s * 100),
            round($l * 100)
        );
    }
}

if (!function_exists('getRandomColor')) {
    /**
     * Generate a random color in multiple formats.
     *
     * Example output:
     * [
     *     'hex' => '#2F98D4',
     *     'rgb' => 'rgb(47,152,212)',
     *     'hsl' => 'hsl(201,64%,51%)'
     * ]
     *
     * @return array{
     *     hex:string,
     *     rgb:string,
     *     hsl:string
     * }
     */
    function getRandomColor(): array
    {
        $rgb = getRandomRgb();

        return [
            'hex' => rgbToHex($rgb),
            'rgb' => rgbToCss($rgb),
            'hsl' => rgbToHsl($rgb),
        ];
    }
}

if (!function_exists('getRandomPassword')) {
    /**
     * Generate a random password.
     *
     * The generated password is guaranteed to contain at least one
     * character from each enabled character set.
     *
     * Example output:
     * m7@Q!xP2#Ld9
     *
     * @param int $length Desired password length.
     * @param bool $uppercase Whether to include uppercase letters (A-Z).
     * @param bool $lowercase Whether to include lowercase letters (a-z).
     * @param bool $numbers Whether to include numeric digits (0-9).
     * @param bool $symbols Whether to include special characters.
     * @return string
     *
     * @throws InvalidArgumentException If no character sets are selected.
     * @throws InvalidArgumentException If the requested length is smaller than
     *                                  the number of enabled character sets.
     */
    function getRandomPassword(
        int $length = 16,
        bool $uppercase = true,
        bool $lowercase = true,
        bool $numbers = true,
        bool $symbols = true
    ): string {
        $pool = '';
        $password = [];

        if ($uppercase) {
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

            $pool .= $chars;
            $password[] = $chars[random_int(0, strlen($chars) - 1)];
        }

        if ($lowercase) {
            $chars = 'abcdefghijklmnopqrstuvwxyz';

            $pool .= $chars;
            $password[] = $chars[random_int(0, strlen($chars) - 1)];
        }

        if ($numbers) {
            $chars = '0123456789';

            $pool .= $chars;
            $password[] = $chars[random_int(0, strlen($chars) - 1)];
        }

        if ($symbols) {
            $chars = '!@#$%^&*-_?';

            $pool .= $chars;
            $password[] = $chars[random_int(0, strlen($chars) - 1)];
        }

        if ($pool === '') {
            throw new InvalidArgumentException(
                'At least one character set must be selected.'
            );
        }

        if ($length < count($password)) {
            throw new InvalidArgumentException(
                'Password length is too short for the selected character sets.'
            );
        }

        while (count($password) < $length) {
            $password[] = $pool[random_int(0, strlen($pool) - 1)];
        }

        shuffle($password);

        return implode('', $password);
    }
}
