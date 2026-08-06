<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once './helpers/helper.php';
require_once './helpers/generator.php';
require_once './helpers/object.php';

final class GeneratorTest extends TestCase
{
    public function testGenerateSingleName(): void
    {
        $result = generate('name', 1);

        $this->assertCount(1, $result);
        $this->assertIsString($result[0]);
    }

    public function testGenerateMultipleNames(): void
    {
        $result = generate('name', 10);

        $this->assertCount(10, $result);

        foreach ($result as $name) {
            $this->assertIsString($name);
            $this->assertCount(2, explode(' ', $name));
        }
    }

    public function testGenerateEmails(): void
    {
        $result = generate('email', 20);

        $this->assertCount(20, $result);

        foreach ($result as $email) {
            $this->assertTrue(
                filter_var($email, FILTER_VALIDATE_EMAIL) !== false
            );
        }
    }

    public function testGeneratePhones(): void
    {
        $result = generate('phone', 20);

        $this->assertCount(20, $result);

        foreach ($result as $phone) {
            $this->assertMatchesRegularExpression(
                '/^\+\d+\s\d{9}$/',
                $phone
            );
        }
    }

    public function testGenerateColors(): void
    {
        $result = generate('color', 15);

        $this->assertCount(15, $result);

        foreach ($result as $color) {
            $this->assertArrayHasKey('hex', $color);
            $this->assertArrayHasKey('rgb', $color);
            $this->assertArrayHasKey('hsl', $color);
        }
    }

    public function testGenerateUsers(): void
    {
        $result = generate(
            'user',
            5,
            20,
            true,
            true,
            true,
            true
        );

        $this->assertCount(5, $result);

        foreach ($result as $user) {
            $this->assertIsArray($user);

            $this->assertArrayHasKey('name', $user);
            $this->assertArrayHasKey('email', $user);
            $this->assertArrayHasKey('phone', $user);
            $this->assertArrayHasKey('password', $user);
            $this->assertArrayHasKey('favorite_color', $user);

            $this->assertIsString($user['name']);

            $this->assertTrue(
                filter_var($user['email'], FILTER_VALIDATE_EMAIL) !== false
            );

            $this->assertMatchesRegularExpression(
                '/^\+\d+\s\d{9}$/',
                $user['phone']
            );

            $this->assertSame(20, strlen($user['password']));

            $this->assertIsArray($user['favorite_color']);
            $this->assertArrayHasKey('hex', $user['favorite_color']);
            $this->assertArrayHasKey('rgb', $user['favorite_color']);
            $this->assertArrayHasKey('hsl', $user['favorite_color']);
        }
    }

    public function testGeneratePasswords(): void
    {
        $result = generate(
            'password',
            25,
            32,
            true,
            true,
            true,
            true
        );

        $this->assertCount(25, $result);

        foreach ($result as $password) {
            $this->assertSame(32, strlen($password));
        }
    }

    public function testGenerateUppercasePasswords(): void
    {
        $result = generate(
            'password',
            10,
            24,
            true,
            false,
            false,
            false
        );

        foreach ($result as $password) {
            $this->assertMatchesRegularExpression(
                '/^[A-Z]+$/',
                $password
            );
        }
    }

    public function testGenerateLowercasePasswords(): void
    {
        $result = generate(
            'password',
            10,
            24,
            false,
            true,
            false,
            false
        );

        foreach ($result as $password) {
            $this->assertMatchesRegularExpression(
                '/^[a-z]+$/',
                $password
            );
        }
    }

    public function testGenerateNumbersPasswords(): void
    {
        $result = generate(
            'password',
            10,
            24,
            false,
            false,
            true,
            false
        );

        foreach ($result as $password) {
            $this->assertMatchesRegularExpression(
                '/^\d+$/',
                $password
            );
        }
    }

    public function testGenerateSymbolsPasswords(): void
    {
        $result = generate(
            'password',
            10,
            24,
            false,
            false,
            false,
            true
        );

        foreach ($result as $password) {
            $this->assertMatchesRegularExpression(
                '/^[!@#$%^&*\-_?]+$/',
                $password
            );
        }
    }

    public function testInvalidTypeThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);

        generate('pizza', 5);
    }

    public function testQuantityTooSmallThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);

        generate('name', 0);
    }

    public function testQuantityTooLargeThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);

        generate('name', 10001);
    }

    public function testPasswordLengthTooSmallThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);

        generate(
            'password',
            5,
            3
        );
    }

    public function testPasswordLengthTooLargeThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);

        generate(
            'password',
            5,
            257
        );
    }

    public function testPasswordWithNoCharacterSetsThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);

        generate(
            'password',
            1,
            16,
            false,
            false,
            false,
            false
        );
    }

    public function testPasswordContainsAllSelectedCharacterSets(): void
    {
        $password = generate(
            'password',
            1,
            64,
            true,
            true,
            true,
            true
        )[0];

        $this->assertMatchesRegularExpression('/[A-Z]/', $password);
        $this->assertMatchesRegularExpression('/[a-z]/', $password);
        $this->assertMatchesRegularExpression('/\d/', $password);
        $this->assertMatchesRegularExpression('/[!@#$%^&*\-_?]/', $password);
    }
}
