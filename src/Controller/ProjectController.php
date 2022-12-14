<?php

namespace App\Controller;

use RedBeanPHP\R;
use RedBeanPHP\RedException\SQL;

class ProjectController extends AbstractController
{
    public function index()
    {
        // TODO: Implement index() method.
    }

    /**
     * @throws SQL
     */
    public static function addProject()
    {
        if (isset($_SESSION['user'])) {
            if (isset($_POST['submit'])) {
                if (self::formIsset('titleProject')) {
                    $user = R::findOne('user', 'email=?', [$_SESSION['user']->email]);
                    $project_name = filter_var($_POST['titleProject'], FILTER_SANITIZE_STRING);

                    self::checkRange($project_name, 4, 20, '/?c=home', 'La longueur du titre de projet doit-être comprise entre 4 et 20 caractères');

                    $project = R::dispense('project');
                    $project->project_name = $project_name;
                    $project->project_time = 0;
                    $user->ownProjectList[] = $project;

                    R::store($user);
                    self::render('home/home', [
                        'user_project' => $user->ownProjectList,
                    ]);
                }
            }
            else {
                $_SESSION['error'] .= "/Un champ est manquant/";
                header("Location: /?c=home");
            }
        }
        else {
            $_SESSION['error'] .= "/Veuillez vous connecter pour ajouter un projet/";
            header("Location: /?c=home");
        }
    }

    public static function deleteProject (int $id = null)
    {
        if ($id === null) {
            header("Location: /?c=home");
            exit();
        }
        if (!isset($_SESSION['user'])) {
            header("Location: /?c=home");
            exit();
        }

        $project = R::findOne('project', 'id=?', [$id]);

        if (!$project) {
            header("Location: /?c=home");
            exit();
        }
        if ($_SESSION['user']->id !== $project->user_id) {
            header("Location: /?c=home");
            exit();
        }
        if (isset($_POST['submit'])) {
            R::trash($project);
            $_SESSION['success'] = "Projet supprimer avec succès.";
            header("Location: /?c=home");
        }
    }

    public static function showProject (int $id = null)
    {
        if (null === $id) {
            header("Location: /?c=home");
            exit;
        }

        $project = R::findOne('project', 'id=?', [$id]);

        if (!$project) {
            header("Location: /?c=home");;
            exit;
        }

        if ($_SESSION['user']->id !== $project->user_id) {
            header("Location: /?c=home");
            exit;
        }

        self::render('project/detailProject', [
            'project' => $project,
        ]);
    }
}