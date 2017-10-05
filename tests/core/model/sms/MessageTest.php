<?php
use Test\Burst\Core\Model\SMS\Message;
use Test\Burst\Core\Exceptions\FieldEmptyException;

class MessageTest Extends \PHPUnit\Framework\TestCase
{
    public function testMessageEmpty()
    {
        $this->expectException(FieldEmptyException::class);
        new Message('');
    }

    public function testMessageHasNoLinksExceedsCharacterLength()
    {
        $this->expectException(\OutOfBoundsException::class);
        new Message('asdfasdfdasdfasdfdasdfasdfdasdfasdfdasdfasdfdasdfasdfdasdfasdfdasdfasdfdasdfas
        dfdasdfasdfdasdfasdfdasdfasdfdasdfasdfdasdfasdfdasdfasdfdasdfasdfdasdfasdfdasdfasdfdasdfasd
        fdasdfasdfdasdfasdfdasdfasdfdasdfasdfdasdfasdfdasdfasdfdasdfasdfdasdfasdfdasdfasdfdasdfasdfda
        sdfasdfdasdfasdfdasdfasdfdasdfasdfdasdfasdfdasdfasdfdasdfasdfdasdfasdfdasdfasdfda
        sdfasdfdasdfasdfdasdfasdfdasdfasdfdasdfasdfdasdfasdfdasdfasdfd');
    }

    public function testMessageHasNoLinksValid()
    {
        $message = new Message('This is a sample');

        $result = $message->getMessage();

        $this->assertEquals('This is a sample', $result);
    }


    public function testMessageHasLinksExceedsCharacterLength()
    {
        $this->expectException(\OutOfBoundsException::class);
        $message = new Message('This is a sample http://google.com yahoo.com facebook.com twitter.com gmail.com google.com yahoo.com facebook.com twitter.com gmail.com
         gmail.com google.com yahoo.com facebook.com twitter.com gmail.com
          gmail.com google.com yahoo.com facebook.com twitter.com gmail.com
           gmail.com google.com yahoo.com facebook.com twitter.com gmail.com
            gmail.com google.com yahoo.com facebook.com twitter.com gmail.com
             gmail.com google.com yahoo.com facebook.com twitter.com gmail.com
              gmail.com google.com yahoo.com facebook.com twitter.com gmail.com
               gmail.com google.com yahoo.com facebook.com twitter.com gmail.com
                gmail.com google.com yahoo.com facebook.com twitter.com gmail.com
                 gmail.com google.com yahoo.com facebook.com twitter.com gmail.com
                  gmail.com google.com yahoo.com facebook.com twitter.com gmail.com
                   gmail.com google.com yahoo.com facebook.com twitter.com gmail.com
                    gmail.com google.com yahoo.com facebook.com twitter.com gmail.com');
    }

    public function testMessageHasLinksValid()
    {
        $message = new Message('This is a sample google.com http://yahoo.com https://facebook.com https://twitter.com/test https://facebook.com/test?test=1');

        $result = $message->getMessage();

        $this->assertEquals('This is a sample google.com http://yahoo.com https://facebook.com https://twitter.com/test https://facebook.com/test?test=1', $result);

        $result = $message->getLinks();
        $this->assertEquals(array('http://yahoo.com', 'https://facebook.com', 'https://twitter.com/test', 'https://facebook.com/test?test=1'), $result);
    }
}