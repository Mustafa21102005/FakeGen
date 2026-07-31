<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once './helpers/helper.php';

final class HelperTest extends TestCase
{
    private array $names;
    private array $emails;
    private array $phones;

    protected function setUp(): void
    {
        $this->names = json_decode(
            file_get_contents(__DIR__ . '/../data/names.json'),
            true
        );

        $this->emails = json_decode(
            file_get_contents(__DIR__ . '/../data/emails.json'),
            true
        );

        $this->phones = json_decode(
            file_get_contents(__DIR__ . '/../data/phones.json'),
            true
        );
    }

    public function testRandomFirstNameReturnsString(): void
    {
        $firstName = getRandomFirstName($this->names);

        $this->assertIsString($firstName);
        $this->assertNotEmpty($firstName);
    }

    public function testRandomLastNameReturnsString(): void
    {
        $lastName = getRandomLastName($this->names);

        $this->assertIsString($lastName);
        $this->assertNotEmpty($lastName);
    }

    public function testRandomNameReturnsTwoWords(): void
    {
        $name = getRandomName($this->names);

        $this->assertIsString($name);
        $this->assertCount(2, explode(' ', $name));
    }

    public function testRandomEmailIsValid(): void
    {
        $email = getRandomEmail($this->names, $this->emails);

        $this->assertTrue(
            filter_var($email, FILTER_VALIDATE_EMAIL) !== false
        );
    }

    public function testRandomPhoneMatchesPattern(): void
    {
        $phone = getRandomPhoneNumber($this->phones);

        $this->assertMatchesRegularExpression(
            '/^\+\d+\s\d{9}$/',
            $phone
        );
    }

    public function testRandomRgbValuesAreWithinRange(): void
    {
        $rgb = getRandomRgb();

        foreach (['r', 'g', 'b'] as $channel) {
            $this->assertArrayHasKey($channel, $rgb);
            $this->assertGreaterThanOrEqual(0, $rgb[$channel]);
            $this->assertLessThanOrEqual(255, $rgb[$channel]);
        }
    }

    public function testRgbToHex(): void
    {
        $this->assertSame(
            '#FF0000',
            rgbToHex([
                'r' => 255,
                'g' => 0,
                'b' => 0,
            ])
        );
    }

    public function testRgbToCss(): void
    {
        $this->assertSame(
            'rgb(255,0,0)',
            rgbToCss([
                'r' => 255,
                'g' => 0,
                'b' => 0,
            ])
        );
    }

    public function testRgbToHsl(): void
    {
        $this->assertSame(
            'hsl(0,100%,50%)',
            rgbToHsl([
                'r' => 255,
                'g' => 0,
                'b' => 0,
            ])
        );
    }

    public function testRandomColorContainsExpectedKeys(): void
    {
        $color = getRandomColor();

        $this->assertArrayHasKey('hex', $color);
        $this->assertArrayHasKey('rgb', $color);
        $this->assertArrayHasKey('hsl', $color);
    }

    public function testDefaultPasswordLength(): void
    {
        $password = getRandomPassword();

        $this->assertSame(16, strlen($password));
    }

    public function testUppercaseOnlyPassword(): void
    {
        $password = getRandomPassword(
            32,
            true,
            false,
            false,
            false
        );

        $this->assertMatchesRegularExpression('/^[A-Z]+$/', $password);
    }

    public function testLowercaseOnlyPassword(): void
    {
        $password = getRandomPassword(
            32,
            false,
            true,
            false,
            false
        );

        $this->assertMatchesRegularExpression('/^[a-z]+$/', $password);
    }

    public function testNumbersOnlyPassword(): void
    {
        $password = getRandomPassword(
            32,
            false,
            false,
            true,
            false
        );

        $this->assertMatchesRegularExpression('/^\d+$/', $password);
    }

    public function testSymbolsOnlyPassword(): void
    {
        $password = getRandomPassword(
            32,
            false,
            false,
            false,
            true
        );

        $this->assertMatchesRegularExpression(
            '/^[!@#$%^&*\-_?]+$/',
            $password
        );
    }

    public function testPasswordContainsAllSelectedCharacterTypes(): void
    {
        $password = getRandomPassword(
            64,
            true,
            true,
            true,
            true
        );

        $this->assertMatchesRegularExpression('/[A-Z]/', $password);
        $this->assertMatchesRegularExpression('/[a-z]/', $password);
        $this->assertMatchesRegularExpression('/\d/', $password);
        $this->assertMatchesRegularExpression('/[!@#$%^&*\-_?]/', $password);
    }

    public function testThrowsExceptionWhenNoCharacterSetSelected(): void
    {
        $this->expectException(InvalidArgumentException::class);

        getRandomPassword(
            16,
            false,
            false,
            false,
            false
        );
    }

    public function testThrowsExceptionWhenLengthTooShort(): void
    {
        $this->expectException(InvalidArgumentException::class);

        getRandomPassword(
            3,
            true,
            true,
            true,
            true
        );
    }
}
