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
        $isWinning = '';
        if (strstr($egg['power'], 'increase')) {
            $title = 'Yay !';

            $isWinning = 'getting';
        } elseif (strstr($egg['power'], 'decrease')) {
            $title = 'Crap !';
            $isWinning = 'losing';
        }

        $number = 0;
        $size = 0;
        if (strstr($egg['caliber'], 'XS')) {
            $number = 1;
            $size = 'a tiny';
        } elseif (strstr($egg['caliber'], 'S')) {
            $number = 2;
            $size = 'a small';
        } elseif (strstr($egg['caliber'], 'M')) {
            $number = 3;
            $size = 'a regular';
        } elseif (strstr($egg['caliber'], 'L')) {
            $number = 4;
            $size = 'a large';
        }

        if (strstr($egg['caliber'], 'XL')) {
            $number = 5;
            $size = 'an extra large';
        }
        if (strstr($egg['caliber'], '2XL')) {
            $number = 6;
            $size = 'a huge';
        }
        if (strstr($egg['caliber'], '3XL')) {
            $number = 7;
            $size = 'an ENORMOUS';
        }

        $_SESSION['eggCount'] = $eggCount;
        return $this->twig->render('Home/index.html.twig', ['egg' => $egg, 'character' => $character,
            'title' => $title, 'isWinning' => $isWinning, 'number' => $number, 'size' => $size,
            'eggCount' => $eggCount]);
    }
}
