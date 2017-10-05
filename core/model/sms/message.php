<?php
namespace Test\Burst\Core\Model\SMS;

use Test\Burst\Core\Exceptions\FieldEmptyException;

/**
 * Class Message
 * @package Test\Burst\Core\Model\SMS
 *
 * @author Rai Icasiano <ricasiano at gmail dot com>
 */
class Message
{
    const CHARACTERS_PER_MESSAGE = 67;
    const BITLY_URL_LENGTH = 23;
    private $message;
    private $messagePartCount = 3;
    private $links = array();

    public function __construct($message)
    {
        $this->validateMessage($message);
    }

    /**
     * @param $message
     * @throws FieldEmptyException
     */
    private function validateMessage($message)
    {
        if (0 >= strlen($message)) {
            throw new FieldEmptyException('Message is required.');
        }

        $totalLinks = preg_match_all('((https?:\/\/)([-\w]+\.[-\w\.]+)+\w(:\d+)?(\/([-\w\/_\.\,]*(\?\S+)?)?)*)', $message, $matchedLinks);

        //found links, use different character count logic
        if (0 < $totalLinks) {
            $bitlyMessage = $message;
            $bitlyPlaceHolder = str_pad('', self::BITLY_URL_LENGTH, 'X');
            $actualLinks = $matchedLinks[0];
            $this->links = $actualLinks;
            array_unique($actualLinks);
            foreach($actualLinks as $link) {
                //mock the bitly url to x number of characters to simulate total count
                $bitlyMessage = str_replace($link, $bitlyPlaceHolder, $bitlyMessage);
            }

            $this->checkIfMessageCharacterCountExceeds($bitlyMessage);
        }
        else{
            $this->checkIfMessageCharacterCountExceeds($message);
        }
        //we still use the original message, as this will be the identifier when we got the actual bitly link
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    private function checkIfMessageCharacterCountExceeds($message)
    {
        //compare total max characters on an N part message
        if (strlen($message) > self::CHARACTERS_PER_MESSAGE * $this->messagePartCount)
        {
            throw new \OutOfBoundsException('Message exceeds max number of characters');
        }
    }

    /**
     * @return mixed
     */
    public function getMessagePartCount()
    {
        return $this->messagePartCount;
    }

    /**
     * @param mixed $messagePartCount
     */
    public function setMessagePartCount($messagePartCount)
    {
        $this->messagePartCount = $messagePartCount;
    }

    /**
     * links are extracted from the setMessage setter
     *
     * @return mixed
     */
    public function getLinks()
    {
        return $this->links;
    }
}