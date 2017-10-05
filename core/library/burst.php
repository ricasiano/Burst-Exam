<?php
namespace Test\Burst\Core\Library;

use Test\Burst\Core\Model\SMS\Number;

/**
 * Class Burst
 * @package Test\Burst\Core\Library
 *
 * @author Rai Icasiano <ricasiano at gmail dot com>
 */
class Burst
{
    private $number;
    private $message;
    //must move to separate config file, calling the ENVVARS
    private $APIUrl = BURST_API_URL;
    private $APIKey = BURST_API_KEY;
    private $APISecret = BURST_API_SECRET;

    public function __construct(Number $number, $message = '')
    {
        $this->number = $number;
        $this->message = $message;
    }

    public function invoke()
    {
        //should've used a curl library, making this a wrapper
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->APIUrl . 'send-sms.json');
        curl_setopt($ch, CURLOPT_USERPWD, $this->APIKey . ':' . $this->APISecret);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            'message=' . $this->message. '&to=' . $this->number->getNumber());

        //should handle error responses as well
        $return = curl_exec($ch);

        curl_close($ch);
    }
}