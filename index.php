<?php
use Test\Burst\Core\Router;
use Test\Burst\Core\Exceptions\InvalidIndexException;
use Test\Burst\Core\Exceptions\PageNotFoundException;
/**
 * Burst Exam
 *
 * @author Rai Icasiano <ricasiano at gmail dot com>
 *
 * @codeCoverageIgnore
 */
include_once ('core/config.php');
include_once ('vendor/autoload.php');
include_once ('core/router.php');
try {
    $router = new Router($_SERVER['REQUEST_URI']);
    $router->render()->view();

}
catch (InvalidIndexException $e) {
    header('location: index.php');
}
catch (PageNotFoundException $e) {
    include_once ('core/view/404.php');
}
catch (Exception $e) {
    echo 'An unknown error occurred';
}
