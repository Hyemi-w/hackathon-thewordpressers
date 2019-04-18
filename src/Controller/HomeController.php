<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

class HomeController extends AbstractController
{
    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */


    public function index()
    {
        $_SESSION['eggCount'] = 0;
        $eggCount = $_SESSION['eggCount'];
        return $this->twig->render('Home/index.html.twig', ['eggCount' => $eggCount]);
    }
}
