<?php

/*
 * Pour appeler cette fonction, il faut :
 *require_once __DIR__ . '/../src/Functions/randomEgg.php';
*/

use GuzzleHttp\Client;

function randomEgg(): array
{
    $client = new Client([
            'base_uri' => 'http://easteregg.wildcodeschool.fr/api/',
            'timeout' => 2.0,
        ]);

    $response = $client->request('GET', 'eggs/random');


    $body = $response->getBody();

    $array = (json_decode($body->getContents(), true));

//    echo "<pre>";
//    var_dump($array);
//    echo "</pre>";

//    echo "<strong>Name: " . $array["name"];

//echo "<pre>";
//var_dump(json_decode($body->getContents(), true));
//echo "</pre>";

    return $array;
}
