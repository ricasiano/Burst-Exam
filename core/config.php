<?php
/**
 * Bootstrap config file
 *
 * @author Rai Icasiano <ricasiano at gmail dot com>
 */
//config files, all values here must be moved to envvars
define('BURST_API_URL', 'http://api.transmitsms.com/');
define('BURST_API_KEY', $_ENV['BURST_API_KEY']);
define('BURST_API_SECRET', $_ENV['BURST_API_SECRET']);
define('BITLY_ACCESS_TOKEN', $_ENV['BITLY_ACCESS_TOKEN']);
define('ROOT_URL_WITH_INDEX', 'http://localhost/burst/index.php/');