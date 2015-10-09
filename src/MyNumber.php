<?php namespace Serima\MyNumber;

class MyNumber
{
    /**
     * Check the number of digits.
     * Pass the number as string, if starting letter is beginning zero.
     *
     * @param integer|string $number
     * @param integer $digit
     * @return bool
     */
    public static function checkLength($number, $digit)
    {
        if (strlen($number) !== $digit || strspn($number, '1234567890') !== $digit) {
            return false;
        }
        return true;
    }

    /**
     * Verify personal MyNumber.
     * Pass the number as string, if starting letter is beginning zero.
     *
     * @param integer|string $number
     * @return bool
     * @link http://law.e-gov.go.jp/announce/H26F11001000085.html
     */
    public static function verifyPersonal($number)
    {
        if (false === self::checkLength($number, 12)) {
            return false;
        }

        $sum = 0;
        for ($i = 1; $i <= 11; $i++) {
            $m = (int)substr($number, 11 - $i, 1);
            $n = ($i <= 6) ? $i + 1 : $i - 5;
            $sum += $m * $n;
        }
        $mod = $sum % 11;

        if ($mod <= 1) {
            return ((int)substr($number, 11, 1) === 0);
        }
        return ((int)substr($number, 11, 1) === 11 - $mod);
    }

    /**
     * Verify company MyNumber.
     * Pass the number as string, if starting letter is beginning zero.
     *
     * @param integer|string $number
     * @return bool
     * @link http://law.e-gov.go.jp/announce/H26F14001000070.html
     */
    public static function verifyCompany($number)
    {
        if (false === self::checkLength($number, 13)) {
            return false;
        }

        $sum = 0;
        for ($i = 1; $i <= 12; $i++) {
            $m = (int)substr($number, 12 - $i, 1);
            $n = ($i % 2 === 0) ? 2 : 1;
            $sum += $m * $n;
        }
        $mod = $sum % 9;

        return ((int)substr($number, 12, 1) === 9 - $mod);
    }
}
