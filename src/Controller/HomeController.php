<?php

namespace App\Controller;



use RedBeanPHP\R;

class HomeController extends AbstractController
{

    public function index()
    {
        if (isset($_SESSION['user'])) {
            $user = R::findOne('user', 'email=?', [$_SESSION['user']->email]);
            self::render('home/home', [
                'user_project' => $user->ownProjectList,
            ]);
        }else {
            self::render('home/home');
        }

    }
}