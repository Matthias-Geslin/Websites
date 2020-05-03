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
         if (!empty($this->post['email']) && !empty($this->post['pass'])) {
             $user = ModelMaker::getModel('User')->readData($this->post['email'], 'email');

             if (password_verify($this->post['pass'], $user['pass'])) {
                 $this->sessionCreate($user);
                 $this->redirect('home');
             }
         }

         if ($this->getUserVar('status') === 'Admin' || $this->getUserVar('status') === 'Member') {
             $this->redirect('user');
         }
         elseif ($this->getUserVar('status') === 'Visitor') {
             $this->redirect('home');
         }

         return $this->render('connection.twig');
     }

     /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function logoutMethod()
    {
        $this->sessionDestroy();
        $this->redirect('home');
    }
}
