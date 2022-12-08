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
    public static function addTask(int $id = null)
    {
        if (null == $id) {
            header("Location: /?c=home");
            exit();
        }
        if (isset($_POST['submit'])) {
            if (self::formIsset('titleTask')) {
                if (R::findOne('project', 'id=?', [$id])) {
                    $project = R::findOne('project', 'id=?', [$id]);
                }
                else {
                    header("Location: /?c=home&f=projectDontExist");
                    exit();
                }
                $taskname = filter_var($_POST['titleTask'], FILTER_SANITIZE_STRING);

                $task = R::dispense('task');
                $task->taskname = $taskname;
                $task->time = 0;
                $project->ownTasksList[] = $task;


                R::store($project);

                $user = R::findOne('user', 'email=?', [$_SESSION['user']->email]);
                self::render('home/home', [
                    'user_project' => $user->ownProjectList,
                ]);

            }
        }
    }
}