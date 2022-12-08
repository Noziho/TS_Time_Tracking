<?php

namespace App\Controller;

class HomeController extends AbstractController
{

    public function index()
    {
        if (isset($_SESSION['user'])) {
            self::render('home/home', [
                'user_project' => $_SESSION['user']->ownProjectList,
            ]);
        }else {
            self::render('home/home');
        }

    }
}