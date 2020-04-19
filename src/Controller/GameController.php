<?php
namespace App\Controller;

use App\Model\Maker\ModelMaker;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class GameController
 * Manages the Game page
 * @package App\Controller
 */
 class GameController extends MainController
{
    /**
     * Renders the View Game
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function launchMethod()
    {
        // $game = ModelMaker::getModel('Game')->listData();

        return $this->render('game.twig',[
            // 'game'  => $game
        ]);
    }
}
