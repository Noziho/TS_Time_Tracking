<?php

namespace App\Controller;

class ErrorController extends AbstractController
{
    public static function error404()
    {
        self::render('error/404');
    }

    public function index()
    {
        // TODO: Implement index() method.
    }
}