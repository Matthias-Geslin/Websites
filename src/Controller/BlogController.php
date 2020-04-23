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
     * @return array
     */
    private $post_content = [];

    /**
     * Renders the View Blog
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function launchMethod()
    {
        $blog = ModelMaker::getModel('Blog')->listData();

        return $this->render('blog.twig',[
            'blog'  => $blog
        ]);
    }

    /**
     * @return string
     */
    private function postData()
    {
      $this->post_content['title'] = $this->post['title'];
      $this->post_content['content'] = $this->post['content'];
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function createMethod()
    {
        $title   = $this->post['title'];
        $content = $this->post['content'];
        if (empty($title && $content)) {
            $this->redirect('admin');
        }
        $createdPost = ModelFactory::getModel('Blog')->createIt($title,$content);
        $this->redirect('admin', ['createdPost' => $createdPost]);
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function deleteMethod()
    {
      $id_post = $this->get['id'];

      $post_confirmed = ModelFactory::getModel('Comments')->listData($id_post, 'post_id');

      if (!empty($post_confirmed))
      {
        ModelFactory::getModel('Comments')->deleteData($id_post, 'post_id');
      }

      ModelFactory::getModel('Blog')->deleteData($id_post);

      $this->redirect('admin');
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
        $this->postData();

        ModelFactory::getModel('Blog')->modifyIt($this->get['id'], $this->post_content['title'],$this->post_content['content']);

        $this->redirect('admin');
    }
    $Blog = ModelFactory::getModel('Blog')->readData($this->get['id']);
    $comments = ModelFactory::getModel('Comments')->listData($this->get['id'], 'post_id');

      return $this->render('backend/modifyBlog.twig', [
        'Blog' => $Blog,
        'comments' => $comments
      ]);
    }
}
