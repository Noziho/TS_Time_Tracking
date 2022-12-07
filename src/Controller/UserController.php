<?php

namespace App\Controller;

use RedBeanPHP\R;
use RedBeanPHP\RedException\SQL;

class UserController extends AbstractController
{

    public function index()
    {

    }

    /**
     * @throws SQL
     */
    public static function register()
    {
        self::render('user/register');
        if (isset($_POST['submit'])) {
            if (self::formIsset('email', 'password', 'password_repeat')) {

                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
                $password_repeat = filter_var($_POST['password_repeat'], FILTER_SANITIZE_STRING);

                if ($password !== $password_repeat) {
                    header("Location: /?c=user&a=register&f=notEqualPassword");
                    exit();
                }


                $user = R::findOne('user', 'email=?', [$email]);

                if (null === $user) {
                    $user = R::dispense('user');

                    $user->email = $email;
                    $user->password = password_hash($password, PASSWORD_ARGON2I);

                    R::store($user);
                } else {
                    header("Location: /?c=user&a=register&f=mailExist");
                    exit();
                }


                header("Location: /?c=user&a=login&f=success");
            }


        }
    }

    public static function login()
    {
        self::render('user/login');
        if (isset($_POST['submit'])) {
            if (self::formIsset('email', 'password')) {
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

                //$user = R::dispense('user');

                $user = R::findOne('user', 'email=?', [$email]);
                if ($user !== null) {
                    if ($password === $user->password) {
                        $_SESSION['user'] = $user;
                        header("Location: /?c=home&f=SUCESsLOGINGE");
                        exit();
                    } else {
                        header("Location: /?c=user&a=login&f=ERROrLONGINGE");
                    }
                } else {
                    header("Location: /?c=user&a=login&f=wrongMail");
                }

            }
        }
    }

    public static function logOut ()
    {
        session_destroy();
        header("Location: /?c=home&f=logout");
    }
}