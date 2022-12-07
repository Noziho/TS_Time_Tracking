<?php

namespace App\Controller;

class UserController extends AbstractController
{

    public function index()
    {

    }

    public static function register () {
        self::render('user/register');
    }
}