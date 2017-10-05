<?php
use Test\Burst\Core\Router;
use Test\Burst\Core\Exceptions\PageNotFoundException;
use Test\Burst\Core\Exceptions\InvalidIndexException;

class RouterTest extends \PHPUnit\Framework\TestCase
{
    public function testURIHasNoIndex()
    {
        $router = new Router('test/.php\\<>+\\;');
        $this->expectException(InvalidIndexException::class);
        $router->render();
    }

    public function testURIHasInvalidCharacters()
    {
        $router = new Router('test/index.php\\<>+\\;');
        $this->expectException(PageNotFoundException::class);
        $router->render();
    }
    public function testURIIsNotSet()
    {
        $router = new Router('index.php');
        $this->expectException(PageNotFoundException::class);
        $result = $router->render();

        $this->assertInstanceOf('Test\Burst\Core\Controller\Home', $result);
    }

    public function testURINotFound()
    {
        $router = new Router('index.php/notFoundPath');
        $this->expectException(PageNotFoundException::class);

        $router->render();
    }

    public function testURIFound()
    {
        $router = new Router('index.php/home');

        $result = $router->render();

        $this->assertInstanceOf('Test\\Burst\\Core\\Controller\\Home', $result);
    }
}