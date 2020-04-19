<?php
namespace App\Controller;

use App\Model\Maker\ModelMaker;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class ConnectionController
 * Manages the Connection page
 * @package App\Controller
 */
class ConnectionController extends MainController
{
    /**
     * Renders the View Connection
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function launchMethod()
    {
        return $this->render('connection.twig');
    }
}
