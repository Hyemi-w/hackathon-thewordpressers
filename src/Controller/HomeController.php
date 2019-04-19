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

        $title1 = '';
        $isWinning = '';
        if (strstr($egg['power'], 'increase')) {
            $title1 = 'Yay !';
            $isWinning = 'getting';
        } elseif (strstr($egg['power'], 'decrease')) {
            $title1 = 'Crap !';
            $isWinning = 'losing';
        }

        $eggCount = $_SESSION['eggCount'];
        $number = 0;
        $size = 0;
        if (strstr($egg['caliber'], 'XS')) {
            $number = 1;
            $size = 'a tiny';
            if ($isWinning == 'losing') {
                $number = -1;
            }

        } elseif (strstr($egg['caliber'], 'S')) {
            $number = 2;
            $size = 'a small';
            if ($isWinning == 'losing') {
                $number = -2;
            }
        } elseif (strstr($egg['caliber'], 'M')) {
            $number = 3;
            $size = 'a regular';
            if ($isWinning == 'losing') {
                $number = -3;
            }
        } elseif (strstr($egg['caliber'], 'L')) {
            $number = 4;
            $size = 'a large';
            if ($isWinning == 'losing') {
                $number = -4;
            }
        }
        if (strstr($egg['caliber'], 'XL')) {
            $number = 5;
            $size = 'an extra large';
            if ($isWinning == 'losing') {
                $number = -5;
            }
        }
        if (strstr($egg['caliber'], '2XL')) {
            $number = 6;
            $size = 'a huge';
            if ($isWinning == 'losing') {
                $number = -6;
            }
        }
        if (strstr($egg['caliber'], '3XL')) {
            $number = 7;
            $size = 'an ENORMOUS';
            if ($isWinning == 'losing') {
                $number = -7;
            }
        }

        $isGiving = '';
        if (stristr($character['origin'], 'earth') or strstr($character['origin'], 'Jerusalem')
            or stristr($character['origin'], 'unknow') or stristr($character['origin'], 'Toons City')) {
            $isGiving = 'gives';
            $title =  'Yay !';
        } else {
            $isGiving = 'stoles';
            $title = 'Crap !';
        }

        $gender = '';
        if (stristr($character['gender'], 'Male')) {
            $gender = 'He';
        }

        if (stristr($character['gender'], 'Female')) {
            $gender = 'She';
        }

        if (stristr($character['gender'], 'unknown')) {
            $gender = 'It';
        }

        $skilllen = strlen($character['skills'][1]);
        $skill = substr($character['skills'][1], 0, $skilllen-2);

        $_SESSION['eggCount'] = $eggCount;

        return $this->twig->render('Home/index.html.twig', ['egg' => $egg, 'character' => $character,
            'title' => $title, 'isWinning' => $isWinning, 'number' => $number, 'size' => $size,
            'isGiving' => $isGiving, 'gender' => $gender, 'skill' => $skill, 'title1' => $title1,
            'eggCount' => $eggCount]);
    }
}
