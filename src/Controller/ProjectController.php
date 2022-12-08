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
    public static function addProject ()
    {
        if (isset($_POST['submit'])) {
            if (self::formIsset('titleProject')) {
                $user = R::findOne('user', 'email=?', [$_SESSION['user']->email]);
                $project_name = filter_var($_POST['titleProject'], FILTER_SANITIZE_STRING);
                $project = R::findOne('project', 'project_name=?', [$project_name]);

                if (null === $project) {
                    $project = R::dispense('project');
                    $project->project_name = $project_name;

                } else {
                    header("Location: /?c=home&f=projectAlreadyExist");
                    exit();
                }

                $user->ownProjectList[] = $project;

                R::store($user);

                self::render('home/home', [
                    "user_project" => $user->ownProjectList,
                ]);
            }
        }
    }
}