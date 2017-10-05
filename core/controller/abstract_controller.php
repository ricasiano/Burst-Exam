<?php
namespace Test\Burst\Core\Controller;

/**
 * Class Controller
 * @package Test\Burst\Core\Controller
 * @author Rai Icasiano <ricasiano at gmail dot com>
 */
abstract class Controller
{
    protected $viewFile = 'home.php';

    public function view()
    {
        include_once ('core/view/' . $this->viewFile);
    }
}