<?php
if (isset($data['project'])) {
    $project = $data['project'];
}

?>

<div class="container">
    <div class="projects_container">
        <div class="project">
            <div>
                <h2><?= $project->project_name ?></h2>
            </div>
            <div class="allTasksContainer">
                <?php
                foreach ($project->ownTaskList as $task) { ?>
                <div id="<?= $task->id ?>" class="task padding-1 margin-1">
                    <p><?= $task->taskname ?></p>
                    </div><?php
                }
                ?>
            </div>
        </div>

    </div>
</div>