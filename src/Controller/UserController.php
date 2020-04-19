<?php
namespace App\Controller;

use App\Model\Maker\ModelMaker;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class UserController
 * Manages the User page
 * @package App\Controller
 */
class UserController extends MainController
{
    /**
     * Renders the View User
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function launchMethod()
    {
        // $user = ModelMaker::getModel('User')->listData();

        return $this->render('backend/user.twig',[
            // 'user'  => $user
        ]);
    }
}
