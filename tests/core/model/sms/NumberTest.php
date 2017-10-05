<?php
use Test\Burst\Core\Model\SMS\Number;
use Test\Burst\Core\Exceptions\InvalidNumberException;

class NumberTest extends PHPUnit\Framework\TestCase
{
    public function testHasInvalidCharacters()
    {
        $this->expectException(InvalidNumberException::class);

        new Number('asdf!@#');
    }

    public function testHasNumbersWithInvalidCharacters()
    {
        $this->expectException(InvalidNumberException::class);

        new Number('123sdfsafdsdf');
    }

    public function testLengthIsLessThanTen()
    {
        $this->expectException(InvalidNumberException::class);

        new Number(123456);
    }

    public function testLengthIsMoreThanThirteen()
    {
        $this->expectException(InvalidNumberException::class);

        new Number(12345647891011121314);
    }

    public function testNumberHasZeroPrefix()
    {
        $sms = new Number('09177982781');
        $result = $sms->getNumber();

        $this->assertEquals('639177982781', $result);
    }

    public function testNumberHasNoZeroPrefix()
    {
        $sms = new Number('9177982781');
        $result = $sms->getNumber();

        $this->assertEquals('639177982781', $result);
    }

    public function testNumberHasCountryCode()
    {
        $sms = new Number('639177982781');
        $result = $sms->getNumber();

        $this->assertEquals('639177982781', $result);
    }

    public function testNumberHasPlusSign()
    {
        $sms = new Number('+639177982781');
        $result = $sms->getNumber();

        $this->assertEquals('639177982781', $result);
    }
}