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

    /**
     * @throws SQL
     */
    public static function timeRegister (int $id = null, int $time = null)
    {
        if (null === $id || null === $time) {
            http_response_code(404);
            exit;
        }
        $task = R::findOne('task', 'id=?', [$id]);

        if (isset($_SESSION['time'])) {
            $task->time = $time + $task->time;
        }

        R::store($task);
        echo json_encode([
           'test' => "TestFetch",
           'task' => $task,
        ]);
        http_response_code(200);
        exit;
    }

    public static function deleteTask (int $id = null, int $pId = null) {
        if (null === $id || null === $pId) {
            header("Location: /?c=home");
            exit;
        }

        $task = R::findOne('task', 'id=?', [$id]);

        if (!$task) {
            header("Location: /?c=home");
            exit;
        }

        R::trash($task);

        ProjectController::showProject($pId);

    }
}