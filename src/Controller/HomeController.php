<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use GuzzleHttp\Client;

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
        $client = new Client(['base_uri' => 'http://easteregg.wildcodeschool.fr/api/',]);

        $response = $client->request('GET', 'eggs/random');
        $body = $response->getBody();
        $json = $body->getContents();
        $egg = json_decode($json, true);

        $client = new Client(['base_uri' => 'http://easteregg.wildcodeschool.fr/api/',]);

        $response = $client->request('GET', 'characters/random');
        $body = $response->getBody();
        $json = $body->getContents();
        $character = json_decode($json, true);

        $eggCount = $_SESSION['eggCount'];
        $title = '';
        if (strstr($egg['power'], 'increase')) {
            $title = 'Yay !';
            $eggCount ++;
        } elseif (strstr($egg['power'], 'decrease')) {
            $title = 'Crap !';
            $eggCount --;
        }
        $_SESSION['eggCount'] = $eggCount;
        return $this->twig->render('Home/index.html.twig', ['egg' => $egg, 'character' => $character,
            'title' => $title, 'eggCount' => $eggCount]);
    }
}
