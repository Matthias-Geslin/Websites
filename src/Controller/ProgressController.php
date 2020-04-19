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
        // $progress = ModelMaker::getModel('Progress')->listData();

        return $this->render('progress.twig',[
            // 'progress'  => $progress
        ]);
    }
}
