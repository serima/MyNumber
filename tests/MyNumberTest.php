<?php

declare(strict_types=1);

namespace Serima\MyNumber\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Serima\MyNumber\MyNumber;

final class MyNumberTest extends TestCase
{
    #[DataProvider('provideCheckLength')]
    public function testCheckLength(int|string $number, int $digit, bool $expected): void
    {
        $this->assertSame($expected, MyNumber::checkLength($number, $digit));
    }

    /**
     * @return array<string, array{int|string, int, bool}>
     */
    public static function provideCheckLength(): array
    {
        return [
            '12 digits with leading zero' => ['012345689101', 12, true],
            '12 digits' => ['123456890123', 12, true],
            '12 digits as integer' => [123456890123, 12, true],
            'too short' => ['1234567', 12, false],
            'too long' => ['1234568901234', 12, false],
            'contains a letter' => ['12345689012a', 12, false],
            'full-width digits' => ['１２３４５６７８９０１２', 12, false],
            'empty string' => ['', 12, false],
        ];
    }

    #[DataProvider('providePersonalNumbers')]
    public function testVerifyPersonal(int|string $number, bool $expected): void
    {
        $this->assertSame($expected, MyNumber::verifyPersonal($number));
    }

    /**
     * @return array<string, array{int|string, bool}>
     */
    public static function providePersonalNumbers(): array
    {
        // Base number 12345678901 -> check digit 8, base number 02345678901 -> check digit 3.
        return [
            'valid as integer' => [123456789018, true],
            'valid as string' => ['123456789018', true],
            'check digit 0' => ['123456789010', false],
            'check digit 1' => ['123456789011', false],
            'check digit 2' => ['123456789012', false],
            'check digit 3' => ['123456789013', false],
            'check digit 4' => ['123456789014', false],
            'check digit 5' => ['123456789015', false],
            'check digit 6' => ['123456789016', false],
            'check digit 7' => ['123456789017', false],
            'check digit 9' => ['123456789019', false],
            'leading zero, valid' => ['023456789013', true],
            'leading zero, check digit 0' => ['023456789010', false],
            'leading zero, check digit 1' => ['023456789011', false],
            'leading zero, check digit 2' => ['023456789012', false],
            'leading zero, check digit 4' => ['023456789014', false],
            'leading zero, check digit 5' => ['023456789015', false],
            'leading zero, check digit 6' => ['023456789016', false],
            'leading zero, check digit 7' => ['023456789017', false],
            'leading zero, check digit 8' => ['023456789018', false],
            'leading zero, check digit 9' => ['023456789019', false],
            'remainder 0 -> check digit 0' => ['550000000000', true],
            'remainder 1 -> check digit 0' => ['020000000010', true],
            'too short' => ['12345678901', false],
            'too long (corporate length)' => ['1234567890123', false],
            'contains a letter' => ['12345678901a', false],
        ];
    }

    #[DataProvider('provideCompanyNumbers')]
    public function testVerifyCompany(int|string $number, bool $expected): void
    {
        $this->assertSame($expected, MyNumber::verifyCompany($number));
    }

    /**
     * @return array<string, array{int|string, bool}>
     */
    public static function provideCompanyNumbers(): array
    {
        // The first digit is the check digit. Base number 123456789012 -> check digit 7.
        return [
            'National Tax Agency (real number)' => ['7000012050002', true],
            'Toyota Motor (real number)' => ['1180301018771', true],
            'valid as integer' => [7000012050002, true],
            'check digit 0 (never valid)' => ['0123456789012', false],
            'check digit 1' => ['1123456789012', false],
            'check digit 2' => ['2123456789012', false],
            'check digit 3' => ['3123456789012', false],
            'check digit 4' => ['4123456789012', false],
            'check digit 5' => ['5123456789012', false],
            'check digit 6' => ['6123456789012', false],
            'valid computed number' => ['7123456789012', true],
            'check digit 8' => ['8123456789012', false],
            'check digit 9' => ['9123456789012', false],
            'remainder 0 -> check digit 9' => ['9000000000000', true],
            'tampered base digit' => ['7000012050003', false],
            'too short (personal length)' => ['123456789018', false],
            'too long' => ['71234567890123', false],
            'contains a letter' => ['712345678901a', false],
        ];
    }
}
