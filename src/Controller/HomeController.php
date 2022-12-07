<?php

namespace App\Controller;

class HomeController extends AbstractController
{

    public function index()
    {
        self::render('home/home');
    }
}