<?php
namespace Test\Burst\Core\Controller;

use Test\Burst\Core\Library\Bitly;
use Test\Burst\Core\Library\Burst;
use Test\Burst\Core\Model\SMS\Message;
use Test\Burst\Core\Model\SMS\Number;

/**
 * Class Send
 * @package Test\Burst\Core\Controller
 *
 * @author Rai Icasiano <ricasiano at gmail dot com>
 */
class Send
{
    public function view()
    {
        $error = false;
        $success = false;
        try {
            $numberValue = filter_var(trim($_POST['number']), FILTER_SANITIZE_STRING);
            $messageValue = filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING);
            $number = new Number($numberValue);
            $message = new Message($messageValue);
            $urls = $message->getLinks();
            $messageForSending = $message->getMessage();
            //bitly integration
            foreach ($urls as $url) {
                $bitly = new Bitly();
                $bitlyShortenedURL = $bitly->invoke($url);
                $messageForSending = str_replace($url, $bitlyShortenedURL, $messageForSending);
            }

            //burst integration
            $burst = new Burst($number, $messageForSending);
            $burst->invoke();
            $success = true;
            include_once('./core/view/send.php');

        }
        catch(\Exception $e) {
            $error = $e->getMessage();

            include_once('./core/view/send.php');
        }
    }
}