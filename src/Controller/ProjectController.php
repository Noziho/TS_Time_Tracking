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
        if (isset($_POST['submit'])) {
            if (self::formIsset('titleProject')) {
                $user = R::findOne('user', 'email=?', [$_SESSION['user']->email]);
                $project_name = filter_var($_POST['titleProject'], FILTER_SANITIZE_STRING);
                $project = R::dispense('project');
                $project->project_name = $project_name;
                $user->ownProjectList[] = $project;

                R::store($user);

                self::render('home/home', [
                    'user_project' => $user->ownProjectList,
                ]);

            }


        }
    }

    public static function deleteProject (int $id = null)
    {
        if ($id === null) {
            header("Location: /?c=home");
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
            header("Location: /?c=home&f=deleteSuccess");
        }
    }
}