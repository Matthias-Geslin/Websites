<?php
namespace App\Controller;

use App\Model\Maker\ModelMaker;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class ProgressController
 * Manages the Progress page
 * @package App\Controller
 */
class ProgressController extends MainController
{
    /**
     * Renders the View Progress
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function launchMethod()
    {
        $progress = ModelMaker::getModel('Progress')->listData();

        return $this->render('progress.twig',[
            'progress'  => $progress
        ]);
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
           $file = $this->uploadFile('img/Progress');
       }

       if (empty($this->post)) {
           return $this->render('backend/progressCreate.twig');
       }
       ModelMaker::getModel('Progress')->createData([
           'name'        => $this->post['name'],
           'file'        => $file,
           'link'        => $this->post['link'],
           'year'        => $this->post['year'],
           'description' => $this->post['description'],
           'category'    => $this->post['category']
       ]);
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
        ModelMaker::getModel('Progress')->deleteData($this->get['id']);

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
            $this->uploadingFile('Progress');
        }
        if ($this->getUserVar('status') == 'Admin') {
            $progress = ModelMaker::getModel('Progress')->readData($this->get['id']);

            return $this->render('backend/progressModify.twig', [
                'progress' => $progress
            ]);
        } $this->redirect('home');
    }
}
