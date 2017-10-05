<?php
namespace Test\Burst\Core\Model\SMS;

use Test\Burst\Core\Exceptions\InvalidNumberException;

/**
 * Class Number
 * @package Test\Burst\Core\Model\SMS
 *
 * @author Rai Icasiano <ricasiano at gmail dot com>
 */
class Number
{
    private $number;

    public function __construct($number)
    {
        $this->setNumber($number);
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    private function setNumber($number)
    {
        if (preg_match('/\+?[0-9]{10,13}/', $number)) {
            $number = $this->transformNumber($number);
        }
        else {
            throw new InvalidNumberException('Number is invalid.');
        }

        $this->number = $number;
    }

    /**
     * @param $number
     * @return string
     * @throws InvalidNumberException
     *
     * no franchise checking lol
     */
    private function transformNumber($number)
    {
        if (10 == strlen($number)) {
            $number = '63'.$number;
        }
        else if (11 == strlen($number))
        {
            $number = '63'.substr($number, 1);
        }
        else if(12 == strlen($number)) {
            //do nothing
        }
        else if(13 == strlen($number)) {
            $number = substr($number, 1);
        }
        else {
            throw new InvalidNumberException('Invalid number');
        }

        return $number;
    }
}