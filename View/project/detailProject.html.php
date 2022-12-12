<?php
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
            <div class="allTasksContainer">
                <?php
                foreach ($project->ownTaskList as $task) { ?>
                <div id="<?= $task->id ?>" class="taskDetails padding-1 margin-1">
                    <p><?= $task->taskname ?></p>
                    <form action="/?c=tasks&a=deleteTask&id=<?= $task->id ?>&pId=<?= $project->id ?>" method="post">
                        <input type="submit" name="submit" value="Supprimer">
                    </form>
                </div>

<?php
                }
                ?>
            </div>
        </div>

    </div>
</div>