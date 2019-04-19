<?php
/**
 * Created by PhpStorm.
 * User: wilder9
 * Date: 19/04/19
 * Time: 03:40
 */

namespace App\Controller;

class CreepyHomePage extends AbstractController
{
    /**
     * Display creepy home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        return $this->twig->render('CreepyHomePage/index.html.twig');
    }
}
