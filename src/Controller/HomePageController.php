<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

class HomePageController extends AbstractController
{


    private function trimArray(array $data): array
    {
        foreach ($data as $key => $value) {
            $data[$key] = trim($value);
        }

        return $data;
    }


    public function index()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') { //securisation formulaire
            $data = $this->trimArray($_POST);
            $errors = [];
            if (($data['lastName'] == 'easter') && ($data['firstName'] == 'egg')) {
                header('location:../'); //redirection vers la page de jeux
            }

            if (empty($data['lastName']) || !is_string($data['lastName'])) {
                $errors['lastName'] = 'lastname required';
            }

            if (empty($data['firstName']) || !is_string($data['firstName'])) {
                $errors['firstName'] = 'firstname required';
            }

            if (empty($data['select'])) {
                $errors['select'] = 'How many person will come';
            }

            if (empty($data['suggestion'])) {
                $errors['suggestion'] = 'please give us some information';
            }

            if (empty($errors)) {
                header('Location:index');//redirection

                exit;
            }
        }
        return $this->twig->render('Homepage/index.html.twig');
    }
}
