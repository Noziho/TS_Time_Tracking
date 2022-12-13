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

        $task->time = $time + $task->time;

        R::store($task);

        /**
         * Add all task time to project_time
         */
        $project = R::findOne('project', 'id=?', [$task->project_id]);

        if (!$project) {
            header("Location: /?c=home");
            exit();
        }

        $allTaskTime = [];
        foreach ($project->ownTaskList as $task) {
            $allTaskTime[] += $task->time;
        }

        $project->project_time = array_sum($allTaskTime);

        R::store($project);
        echo json_encode([
           'test' => "TestFetch",
           'task' => $task,
        ]);
        http_response_code(200);
        exit;
    }

    public static function deleteTask (int $id = null, int $pId = null)
    {
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

    /**
     * @throws SQL
     */
    public static function editTime (int $id = null)
    {
        if (null === $id ) {
            header("Location: /?c=home");
            exit;
        }
        $task = R::findOne('task', 'id=?', [$id]);

        if (!$task) {
            header("Location: /?c=home");
            exit;
        }

        $hours = filter_var($_POST['hours'], FILTER_SANITIZE_NUMBER_INT);
        $minutes = filter_var($_POST['minutes'], FILTER_SANITIZE_NUMBER_INT);
        $seconds = filter_var($_POST['seconds'], FILTER_SANITIZE_NUMBER_INT);


        if ($hours !== 0 && $minutes !== 0 && $seconds !== 0) {
            $hours = filter_var($_POST['hours'], FILTER_SANITIZE_NUMBER_INT) * 3600;
            $minutes = filter_var($_POST['minutes'], FILTER_SANITIZE_NUMBER_INT) * 60;
        }
        else {
            header("Location: /?c=home&f=numberEqualTo0");
            exit;
        }

        if ($hours < 0 || $minutes < 0 || $seconds < 0) {
            header("Location: /?c=home&f=invalidNegativeArgument");
            exit;
        }

        $timeValue = $hours + $minutes + $seconds;

        $task->time = $timeValue;

        R::store($task);

        $project = R::findOne('project', 'id=?', [$task->project_id]);

        if (!$project) {
            header("Location: /?c=home");
            exit();
        }

        $allTaskTime = [];
        foreach ($project->ownTaskList as $task) {
            $allTaskTime[] += $task->time;
        }

        $project->project_time = array_sum($allTaskTime);

        R::store($project);

        header("Location: /?c=home&f=successEditTime");
    }
}