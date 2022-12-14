<?php

use App\Controller\AbstractController;

if (isset($data['project'])) {
    $project = $data['project'];
}

?>

<div class="container">
    <div class="projects_container">
        <div class="projectDetails">
            <div class="containerTitleProject">
                <h2><?= $project->project_name ?></h2>
            </div>
            <div>
                <?php

                $hours = round($project->project_time / 3600);
                $minutes = round($project->project_time / 60);
                $seconds = $project->project_time;

                AbstractController::getHMSFormatDisplay($hours, $minutes, $seconds, '<h3>', 'Temps total: ');

                ?>
            </div>
            <div class="allTasksContainer">
                <?php
                foreach ($project->ownTaskList as $task) { ?>
                <div id="<?= $task->id ?>" class="taskDetails padding-1 margin-1">
                    <p><?= $task->taskname ?></p>
                    <?php
                    $hours = round($task->time / 3600);
                    $minutes = round($task->time / 60);
                    $seconds = $task->time;

                    AbstractController::getHMSFormatDisplay($hours, $minutes, $seconds, '<p>');

                    ?>
                    <form action="/?c=tasks&a=deleteTask&id=<?= $task->id ?>&pId=<?= $project->id ?>" method="post">
                        <input type="submit" name="submit" value="Supprimer">
                    </form>

                    <form action="/?c=tasks&a=editTime&id=<?= $task->id ?>" method="post">
                        <input type="number" name="hours" placeholder="Heures ..." required>
                        <input type="number" name="minutes" placeholder="Minutes ..." required>
                        <input type="number" name="seconds" placeholder="Secondes ..." required>
                        <input type="submit" name="submit" value="Modifier le temps">
                    </form>
                </div><?php
                }
                ?>
            </div>
        </div>
    </div>
</div>