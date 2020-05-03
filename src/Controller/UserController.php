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
      if ($this->getUserVar('status') === 'Admin') {
        $progress    = ModelMaker::getModel('Progress')->listData();
        $blog        = ModelMaker::getModel('Blog')->listData();
        $user        = ModelMaker::getModel('User')->listData();
        $game        = ModelMaker::getModel('Game')->listData();

        return $this->render("backend/user.twig", [
            'progress'    => $progress,
            'blog'        => $blog,
            'user'        => $user,
            'game'        => $game
          ]);
        }
    elseif ($this->getUserVar('status') === 'Member') {
        return $this->render("backend/user.twig");
    }
    $this->redirect('home');
    }


    /**
     * @var array
     */
    private $post_content = [];


    private function postDataUser()
    {
        $this->post_content['name']        = $this->post['name'];
        $this->post_content['email']       = $this->post['email'];

        $this->post_content['status']      = $this->getUserVar('status');
        $this->post_content['file']        = $this->getUserVar('file');
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function createMethod()
    {
        if (!empty($this->getFileVar('name'))) {
            $file = $this->uploadFile('img/User');
        }

        if (empty($this->post)) {
            if ($this->getUserVar('status') == 'Admin') {
                return $this->render('backend/userCreate.twig');
            } $this->redirect('home');
        }

        ModelMaker::getModel('User')->createData([
            'name'        => $this->post['name'],
            'file'        => $file,
            'email'       => $this->post['email'],
            'pass'        => password_hash($this->post['pass'], PASSWORD_DEFAULT)
        ]);

        // Redirection if signup form complete
        if (isset($this->post['signup'])) {
            $user = ModelMaker::getModel('User')->readData($this->post['email'], 'email');
            $this->sessionCreate($user);
            $this->redirect('home');
        }
        $this->redirect('user');
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function deleteMethod()
    {
        ModelMaker::getModel('User')->deleteData($this->get['id']);

        $this->redirect('user');
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function modifyMethod()
    {
        if (!empty($this->post)) {
            $this->uploadingFile('User');
        }
        if ($this->getUserVar('status') == 'Admin') {
            $user = ModelMaker::getModel('User')->readData($this->get['id']);

            return $this->render('backend/userModify.twig', [
                'user' => $user
            ]);

        } $this->redirect('home');
    }

    /**
     * @return string|mixed
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function usereditMethod()
    {
        if (!empty($this->post)) {
            $this->postDataUser();

            ModelMaker::getModel('User')->updateData($this->get['id'], $this->post_content);
            $user = ModelMaker::getModel('User')->readData($this->post['email'], 'email');

            $this->sessionDestroy();
            $this->sessionCreate($user);

            $this->redirect('user');
        }
        $userInfo = ModelMaker::getModel('User')->readData($this->get['id']);

        return $this->render('backend/user.twig',[
            'user' => $userInfo
        ]);
    }
}
