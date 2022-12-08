<?php

namespace App\Controller;

use RedBeanPHP\R;
use RedBeanPHP\RedException\SQL;

class TasksController extends AbstractController
{

    public function index()
    {
        // TODO: Implement index() method.
    }

    /**
     * @throws SQL
     */
    public static function addTask (string $project_name)
    {

        //TODO: passer l'id du projet et pas le nom du projet pour cause de doublon de nom.
        if (isset($_POST['submit'])) {
            if (self::formIsset('titleTask')) {
                if (R::findOne('project', 'project_name=?', [$project_name])) {
                    $project = R::findOne('project', 'project_name=?', [$project_name]);
                }
                else {
                    header("Location: /?c=home&f=projectDontExist");
                }
                $taskname = filter_var($_POST['titleTask'], FILTER_SANITIZE_STRING);

                $task = R::findOne('task', 'taskname=?', [$taskname]);

                if (null === $task) {
                    $task = R::dispense('task');
                    $task->taskname = $taskname;
                    $task->time = 0;
                    $project->ownTasksList[] = $task;

                } else {
                    header("Location: /?c=home&f=TaskAlreadyExist");
                    exit();
                }

                R::store($project);

                $user = R::findOne('user', 'email=?', [$_SESSION['user']->email]);
                self::render('home/home', [
                    'user_project' => $user->ownProjectList,
                ]);

            }
        }
    }
}