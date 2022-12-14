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

                self::checkRange($email, 6, 150, '/?c=user&a=register', '/La longueur de l\'email doit-être comprise entre 6 et 150 caractères');
                self::checkRange($password, 8, 40,'/?c=user&a=register', '/La longueur du mot de passe doit-être compris entre 8 et 40 caractères' );

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $_SESSION['error'] .= "/Le mail n'est pas au format exemple@exemple.com/";
                    header("Location: /?c=user&a=register");
                    exit();
                }

                if ($password !== $password_repeat) {
                    $_SESSION['error'] .= "/Les mots de passes ne corresponde pas/";
                    header("Location: /?c=user&a=register");
                    exit();
                }

                $user = R::findOne('user', 'email=?', [$email]);

                if (null === $user) {
                    $user = R::dispense('user');

                    $user->email = $email;
                    $user->password = password_hash($password, PASSWORD_ARGON2I);

                    R::store($user);
                } else {
                    $_SESSION['error'] .= "/L'adresse mail existe déjà/";
                    header("Location: /?c=user&a=register");
                    exit();
                }

                $_SESSION['success'] = "Votre inscription à été validée.";
                header("Location: /?c=user&a=login");
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
                $user = R::findOne('user', 'email=?', [$email]);

                if ($user !== null) {
                    if (password_verify($password, $user->password)) {
                        $_SESSION['user'] = $user;
                        $_SESSION['success'] = "Connecté avec succès.";
                        header("Location: /?c=home");
                        exit();
                    } else {
                        $_SESSION['error'] .= "/Mot de passe incorrect/";
                        header("Location: /?c=user&a=login");
                    }
                } else {
                    $_SESSION['error'] .= "/Le compte n'existe pas/";
                    header("Location: /?c=user&a=login");
                }
            }
        }
    }

    public static function logOut ()
    {
        unset($_SESSION['user']);
        $_SESSION['success'] .= "/Déconnecté avec succès/";
        header("Location: /?c=home");
    }

    public static function profil (int $id = null) {
        if (null === $id) {
            header("Location: /?c=home");
            exit();
        }
        $user = R::findOne('user', 'id=?', [$id]);

        if (!$user) {
            $_SESSION['error'] = "Error.";
            header("Location: /?c=home");
        }

        if ($_SESSION['user']->id === $user->id) {
            self::render('user/profil', [
                "user" => $user,
            ]);
        }
        else {
            $_SESSION['error'] = "Accès refuser.";
            header("Location: /?c=home");
        }

    }

    public static function delete (int $id = null) {

        if (null === $id) {
            header("Location: /?c=home");
            exit();
        }

        if (isset($_POST['submit'])) {
            $user = R::findOne('user', 'id=?', [$id]);

            if (!$user) {
                header("Location: /?c=home");
                exit();
            }

            if ($_SESSION['user']->id === $user->id) {
                R::trash($user);
                $_SESSION['success'] .= "/Votre compte à été supprimer avec succès/";
                self::logOut();
            }
            else {
                header("Location: /?c=user&a=profil&id=$id");
                exit();
            }

        }
        else {
            $_SESSION['error'] = "Un champ est manquant.";
            header("Location: /?c=home");
        }
    }
}