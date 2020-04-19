<?php
namespace App\Controller;

use App\Model\Maker\ModelMaker;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class BlogController
 * Manages the blog page
 * @package App\Controller
 */
class BlogController extends MainController
{
    /**
     * Renders the View Blog
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function launchMethod()
    {
        // $blog = ModelMaker::getModel('Blog')->listData();

        return $this->render('blog.twig',[
            // 'blog'  => $blog
        ]);
    }
}
