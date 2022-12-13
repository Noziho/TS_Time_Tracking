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

                $hours = ceil($project->project_time / 3600);
                $minutes = ceil($project->project_time / 60);
                $seconds = $project->project_time;
                    if ($hours >= 1) {?>
                        <h3>Temps total: <?= $hours ?>h</h3><?php
                        $minutes = 0;
                        $seconds = 0;
                    }

                    if ($hours < 1 && $seconds < 1) {?>
                        <h3>Temps total: <?= $minutes ?>m</h3><?php
                        $seconds = 0;
                    }

                    if ($minutes < 1 && $hours < 1) {?>
                        <h3>Temps total: <?= $seconds ?>s</h3><?php
                        $hours = 0;
                        $minutes = 0;
                    }

                ?>
            </div>
            <div class="allTasksContainer">
                <?php
                foreach ($project->ownTaskList as $task) { ?>
                <div id="<?= $task->id ?>" class="taskDetails padding-1 margin-1">
                    <p><?= $task->taskname ?></p>
                    <?php
                    $hours = ceil($task->time / 3600);
                    $minutes = ceil($task->time / 60);
                    $seconds = $task->time;
                    if ($hours >= 1) {?>
                        <p><?= $hours ?>h</p><?php
                        $minutes = 0;
                        $seconds = 0;
                    }

                    if ($hours < 1 && $seconds < 1) {?>
                        <p><?= $minutes ?>m</p><?php
                        $seconds = 0;
                    }

                    if ($minutes < 1 && $hours < 1) {?>
                        <p><?= $seconds ?>s</p><?php
                        $hours = 0;
                        $minutes = 0;
                    }

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