<?php
use Serima\MyNumber\MyNumber;

class MyNumberTest extends PHPUnit_Framework_TestCase {

    public function test_checkLength()
    {
        $actual = MyNumber::checkLength('012345689101', 12);
        $this->assertTrue($actual);

        $actual = MyNumber::checkLength('123456890123', 12);
        $this->assertTrue($actual);

        $actual = MyNumber::checkLength('1234567', 12);
        $this->assertFalse($actual);

    }

    public function test_verifyPersonal()
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

    public function test_verifyPersonal_startingZero()
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

    public function test_verifyCompany()
    {
        $actual = MyNumber::verifyCompany(1123456789010);
        
        $this->assertFalse($actual);
        $actual = MyNumber::verifyCompany(1123456789011);
        
        $this->assertFalse($actual);
        $actual = MyNumber::verifyCompany(1123456789012);
        
        $this->assertFalse($actual);
        $actual = MyNumber::verifyCompany(1123456789013);
        
        $this->assertFalse($actual);
        $actual = MyNumber::verifyCompany(1123456789014);
        
        $this->assertTrue($actual);
        $actual = MyNumber::verifyCompany(1123456789015);
        
        $this->assertFalse($actual);
        $actual = MyNumber::verifyCompany(1123456789016);
        
        $this->assertFalse($actual);
        $actual = MyNumber::verifyCompany(1123456789017);
        
        $this->assertFalse($actual);
        $actual = MyNumber::verifyCompany(1123456789018);
        
        $this->assertFalse($actual);
        $actual = MyNumber::verifyCompany(1123456789019);
        
        $this->assertFalse($actual);
    }

    public function test_verifyCompany_startingZero()
    {
        $actual = MyNumber::verifyCompany('0234567890100');
        $this->assertFalse($actual);
        $actual = MyNumber::verifyCompany('0234567890111');
        $this->assertTrue($actual);
        $actual = MyNumber::verifyCompany('0234567890122');
        $this->assertFalse($actual);
        $actual = MyNumber::verifyCompany('0234567890133');
        $this->assertFalse($actual);
        $actual = MyNumber::verifyCompany('0234567890144');
        $this->assertFalse($actual);
        $actual = MyNumber::verifyCompany('0234567890155');
        $this->assertFalse($actual);
        $actual = MyNumber::verifyCompany('0234567890166');
        $this->assertFalse($actual);
        $actual = MyNumber::verifyCompany('0234567890177');
        $this->assertFalse($actual);
        $actual = MyNumber::verifyCompany('0234567890188');
        $this->assertFalse($actual);
        $actual = MyNumber::verifyCompany('0234567890199');
        $this->assertFalse($actual);
    }
}