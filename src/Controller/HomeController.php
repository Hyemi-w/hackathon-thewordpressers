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

        $title = '';
        $isWinning = '';
        if (strstr($egg['power'], 'increase')) {
            $title = 'Yay !';
            $isWinning = 'getting';
        } elseif (strstr($egg['power'], 'decrease')) {
            $title = 'Crap !';
            $isWinning = 'losing';
        }
        $numberDisplay = $_SESSION['eggCount'];
        $eggCount = $_SESSION['eggCount'];
        $number = 0;
        $size = 0;
        if (strstr($egg['caliber'], 'XS')) {
            $number = 1;
            $size = 'a tiny';
            if ($isWinning == 'getting') {
                $eggCount += 1;
            } else {
                $eggCount -= 1;
            }
        } elseif (strstr($egg['caliber'], 'S')) {
            $number = 2;
            $size = 'a small';
            if ($isWinning == 'getting') {
                $eggCount += 2;
            } else {
                $eggCount -= 2;
            }
        } elseif (strstr($egg['caliber'], 'M')) {
            $number = 3;
            $size = 'a regular';
            $eggCount += 3;
            if ($isWinning == 'getting') {
                $eggCount += 3;
            } else {
                $eggCount -= 3;
            }
        } elseif (strstr($egg['caliber'], 'L')) {
            $number = 4;
            $size = 'a large';
            $eggCount += 4;
            if ($isWinning == 'getting') {
                $eggCount += 4;
            } else {
                $eggCount -= 4;
            }
        }

        if (strstr($egg['caliber'], 'XL')) {
            $number = 5;
            $size = 'an extra large';
            $eggCount += 5;
            if ($isWinning == 'getting') {
                $eggCount += 5;
            } else {
                $eggCount -= 5;
            }
        }
        if (strstr($egg['caliber'], '2XL')) {
            $number = 6;
            $size = 'a huge';
            $eggCount += 6;
            if ($isWinning == 'getting') {
                $eggCount += 6;
            } else {
                $eggCount -= 6;
            }
        }
        if (strstr($egg['caliber'], '3XL')) {
            $number = 7;
            $size = 'an ENORMOUS';
            $eggCount += 7;
            if ($isWinning == 'getting') {
                $eggCount += 7;
            } else {
                $eggCount -= 7;
            }
        }
        $_SESSION['eggCount'] = $eggCount;
        return $this->twig->render('Home/index.html.twig', ['egg' => $egg, 'character' => $character,
            'title' => $title, 'isWinning' => $isWinning, 'number' => $number, 'size' => $size,
            'eggCount' => $eggCount, 'numberDisplay' => $numberDisplay]);
    }
}
