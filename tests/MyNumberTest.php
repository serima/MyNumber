<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Serima\MyNumber\MyNumber;

class MyNumberTest extends TestCase
{
    public function test_checkLength(): void
    {
        $actual = MyNumber::checkLength('012345689101', 12);
        $this->assertTrue($actual);

        $actual = MyNumber::checkLength('123456890123', 12);
        $this->assertTrue($actual);

        $actual = MyNumber::checkLength('1234567', 12);
        $this->assertFalse($actual);
    }

    public function test_verifyPersonal(): void
    {
        $actual = MyNumber::verifyPersonal(123456789010);
        $this->assertFalse($actual);
        $actual = MyNumber::verifyPersonal(123456789011);
        $this->assertFalse($actual);
        $actual = MyNumber::verifyPersonal(123456789012);
        $this->assertFalse($actual);
        $actual = MyNumber::verifyPersonal(123456789013);
        $this->assertFalse($actual);
        $actual = MyNumber::verifyPersonal(123456789014);
        $this->assertFalse($actual);
        $actual = MyNumber::verifyPersonal(123456789015);
        $this->assertFalse($actual);
        $actual = MyNumber::verifyPersonal(123456789016);
        $this->assertFalse($actual);
        $actual = MyNumber::verifyPersonal(123456789017);
        $this->assertFalse($actual);
        $actual = MyNumber::verifyPersonal(123456789018);
        $this->assertTrue($actual);
        $actual = MyNumber::verifyPersonal(123456789019);
        $this->assertFalse($actual);
    }

    public function test_verifyPersonal_startingZero(): void
    {
        $actual = MyNumber::verifyPersonal('023456789010');
        $this->assertFalse($actual);
        $actual = MyNumber::verifyPersonal('023456789011');
        $this->assertFalse($actual);
        $actual = MyNumber::verifyPersonal('023456789012');
        $this->assertFalse($actual);
        $actual = MyNumber::verifyPersonal('023456789013');
        $this->assertTrue($actual);
        $actual = MyNumber::verifyPersonal('023456789014');
        $this->assertFalse($actual);
        $actual = MyNumber::verifyPersonal('023456789015');
        $this->assertFalse($actual);
        $actual = MyNumber::verifyPersonal('023456789016');
        $this->assertFalse($actual);
        $actual = MyNumber::verifyPersonal('023456789017');
        $this->assertFalse($actual);
        $actual = MyNumber::verifyPersonal('023456789018');
        $this->assertFalse($actual);
        $actual = MyNumber::verifyPersonal('023456789019');
        $this->assertFalse($actual);
    }

    public function test_verifyCompany(): void
    {
        // Check digit is the FIRST digit per 法人番号の指定等に関する省令 第2条
        // Base: 123456789018, sum=80, 80%9=8, check=9-8=1 → valid: 1123456789018
        $actual = MyNumber::verifyCompany(1123456789018);
        $this->assertTrue($actual);
        $actual = MyNumber::verifyCompany(2123456789018);
        $this->assertFalse($actual);
        $actual = MyNumber::verifyCompany(3123456789018);
        $this->assertFalse($actual);
        $actual = MyNumber::verifyCompany(4123456789018);
        $this->assertFalse($actual);
        $actual = MyNumber::verifyCompany(5123456789018);
        $this->assertFalse($actual);
        $actual = MyNumber::verifyCompany(6123456789018);
        $this->assertFalse($actual);
        $actual = MyNumber::verifyCompany(7123456789018);
        $this->assertFalse($actual);
        $actual = MyNumber::verifyCompany(8123456789018);
        $this->assertFalse($actual);
        $actual = MyNumber::verifyCompany(9123456789018);
        $this->assertFalse($actual);
    }

    public function test_verifyCompany_startingZero(): void
    {
        // Base number starting with zero: 023456789012
        // sum=72, 72%9=0, check=9-0=9 → valid: 9023456789012
        $actual = MyNumber::verifyCompany('1023456789012');
        $this->assertFalse($actual);
        $actual = MyNumber::verifyCompany('2023456789012');
        $this->assertFalse($actual);
        $actual = MyNumber::verifyCompany('3023456789012');
        $this->assertFalse($actual);
        $actual = MyNumber::verifyCompany('4023456789012');
        $this->assertFalse($actual);
        $actual = MyNumber::verifyCompany('5023456789012');
        $this->assertFalse($actual);
        $actual = MyNumber::verifyCompany('6023456789012');
        $this->assertFalse($actual);
        $actual = MyNumber::verifyCompany('7023456789012');
        $this->assertFalse($actual);
        $actual = MyNumber::verifyCompany('8023456789012');
        $this->assertFalse($actual);
        $actual = MyNumber::verifyCompany('9023456789012');
        $this->assertTrue($actual);
    }
}
