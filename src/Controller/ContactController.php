<?php
namespace App\Controller;

use App\Model\Maker\ModelMaker;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class ContactController
 * Manages the Contact page
 * @package App\Controller
 */
class ContactController extends MainController
{
    /**
     * Renders the View Contact
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function launchMethod()
    {
        return $this->render('contact.twig');
    }
}
