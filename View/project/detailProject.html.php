<?php

use App\Controller\AbstractController;

if (isset($data['project'])) {
    $project = $data['project'];
}

?>

<div class="container">
    <div class="projects_container">
        <div class="project">
            <div class="containerTitleProject">
                <h2><?= $project->project_name ?></h2>
            </div>
            <div>
                <?php
                /**
                 * Display format H::M::S
                 */
                $hours = round($project->project_time /3600);
                $minutes = round($project->project_time /60);

                AbstractController::getHMSFormatDisplay($hours, $minutes, $project->project_time, '<h3>', 'Temps total: ');
                ?>
            </div>
            <div class="allTasksContainer">
                <?php
                foreach ($project->ownTaskList as $task) { ?>
                <div id="<?= $task->id ?>" class="taskDetails padding-1 margin-1">
                    <p><?= $task->taskname ?></p>
                    <?php
                        $hours = round($task->time /3600);
                        $minutes = round($task->time /60);

                        AbstractController::getHMSFormatDisplay($hours, $minutes, $task->time, '<p>');
                    ?>
                    <form action="/?c=tasks&a=deleteTask&id=<?= $task->id ?>&pId=<?= $project->id ?>" method="post">
                        <input type="submit" name="submit" value="Supprimer">
                    </form>
                </div><?php
                }
                ?>
            </div>
        </div>
    </div>
</div>