<?php
namespace Test\Burst\Core;

use Test\Burst\Core\Exceptions\InvalidIndexException;
use Test\Burst\Core\Exceptions\PageNotFoundException;
use Test\Burst\Core\Controller\Home;

/**
 * Class Router
 * @package Test\Burst\Core
 *
 * @author Rai Icasiano <ricasiano at gmail dot com>
 */
class Router
{
    private $path;
    private $indexPath = 'index.php';

    public function __construct($path = null)
    {
        $this->path = $path;
    }

    public function render()
    {
        if (false === strstr($this->path, $this->indexPath)) {
            throw new InvalidIndexException;
        }
        else {
            return $this->renderNonHomePage();
        }
    }

    private function renderNonHomePage()
    {
        $path = explode($this->indexPath, $this->path);

        if (1 < count($path) && '' != $path[1]) {
            $subPage = str_replace('/', '', $path[1]);
            return $this->renderSubPage($subPage);
        }
        else {
            return new Home();
        }
    }

    private function renderSubPage($subPage)
    {
        $result = preg_match('/[a-zA-Z0-9_].*/', $subPage);
        if (1 !== $result) {
            throw new PageNotFoundException();
        }
        else {
            $subPageController = ucfirst(strtolower($subPage));
            $controllerNameSpace = 'Test\\Burst\\Core\Controller\\' . $subPageController;

            if (class_exists($controllerNameSpace)){
                return new $controllerNameSpace;
            }
            else {
                throw new PageNotFoundException;
            }
        }
    }
}