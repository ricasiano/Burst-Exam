<?php
namespace Test\Burst\Core\Library;

/**
 * Class Bitly
 * @package Test\Burst\Core\Library
 *
 * Wrapper for 3rdParty bitly integration
 *
 * @author Rai Icasiano <ricasiano at gmail dot com>
 *
 * @codeCoverageIgnore
 */
class Bitly
{
    private $OAUTHAccessToken = BITLY_ACCESS_TOKEN;

    public function invoke($url)
    {
        include_once ('./3rd_party/bitly.php');

        $params = array();
        $params['access_token'] = $this->OAUTHAccessToken;
        $params['longUrl'] = $url;
        $result = bitly_get('shorten', $params);

        return $result['data']['url'];
    }
}