<?php

declare(strict_types=1);

namespace Serima\MyNumber;

class MyNumber
{
    /**
     * Check that the value consists only of ASCII digits and has exactly the given length.
     * Pass the number as a string if it has leading zeros.
     */
    public static function checkLength(int|string $number, int $digit): bool
    {
        $number = (string) $number;

        return strlen($number) === $digit && strspn($number, '0123456789') === $digit;
    }

    /**
     * Verify an Individual Number (個人番号, 12 digits).
     *
     * The number consists of an 11-digit base number followed by a check digit.
     * With P(n) being the n-th digit of the base number counted from the right and
     * Q(n) = n + 1 (n <= 6) or n - 5 (n >= 7), the check digit is
     * 11 - (sum of P(n) * Q(n) mod 11), or 0 when the remainder is 0 or 1.
     *
     * Pass the number as a string if it has leading zeros.
     *
     * @link https://laws.e-gov.go.jp/document?lawid=426M60000008085 平成26年総務省令第85号 第5条
     */
    public static function verifyPersonal(int|string $number): bool
    {
        $number = (string) $number;

        if (!self::checkLength($number, 12)) {
            return false;
        }

        $sum = 0;
        for ($n = 1; $n <= 11; $n++) {
            $p = (int) $number[11 - $n];
            $q = $n <= 6 ? $n + 1 : $n - 5;
            $sum += $p * $q;
        }
        $remainder = $sum % 11;
        $checkDigit = $remainder <= 1 ? 0 : 11 - $remainder;

        return (int) $number[11] === $checkDigit;
    }

    /**
     * Verify a Corporate Number (法人番号, 13 digits).
     *
     * The number consists of a check digit PREPENDED to a 12-digit base number.
     * With P(n) being the n-th digit of the base number counted from the right and
     * Q(n) = 1 (n odd) or 2 (n even), the check digit is
     * 9 - (sum of P(n) * Q(n) mod 9).
     *
     * Pass the number as a string if you keep it in string form; integers work too
     * since a corporate number never starts with 0 (the check digit is 1-9).
     *
     * @link https://laws.e-gov.go.jp/document?lawid=426M60000040070 平成26年財務省令第70号 第2条
     */
    public static function verifyCompany(int|string $number): bool
    {
        $number = (string) $number;

        if (!self::checkLength($number, 13)) {
            return false;
        }

        $sum = 0;
        for ($n = 1; $n <= 12; $n++) {
            $p = (int) $number[13 - $n];
            $q = $n % 2 === 0 ? 2 : 1;
            $sum += $p * $q;
        }
        $checkDigit = 9 - ($sum % 9);

        return (int) $number[0] === $checkDigit;
    }
}
