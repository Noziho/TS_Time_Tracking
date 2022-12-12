<?php
if (isset($data['user_project'])) {
    $projects = $data['user_project'];
}

?>

<div class="container">
    <form class="createProjectContainer" action="/?c=project&a=addproject" method="post">
        <input type="text" class="padding-1 margin-top-1" name="titleProject" required minlength="4" placeholder="Nom du projet ...">
        <input type="submit" name="submit" value="addProject">
    </form>

    <div class="projects_container padding-4">
        <?php
        if (isset($_SESSION['user'])) {
            foreach ($projects as $project) {?>
                <div class="project margin-2">
                    <div class="containerTitleProject">
                        <h2><?= $project->project_name; ?></h2>
                    </div>
                    <form action="/?c=tasks&a=addTask&id=<?= $project->id ?>" method="post">
                        <div class="labelContainer">
                            <label for="titleTask">Ajouter une tâche :</label>
                        </div>
                        <input type="text" name="titleTask" id="titleTask" placeholder="Nom de la tâche ...">
                        <input id="addTaskButton" type="submit" name="submit" value="+">
                    </form>

                    <div class="allTasksContainer">

                    <?php
                        foreach ($project->ownTaskList as $task) {?>
                            <div id="<?= $task->id ?>" class="task padding-1 margin-1">
                                <p><?= $task->taskname ?></p>
                            </div>
                    <?php
                        }
                    ?>
                    </div>

                    <div>
                        <a href="/?c=project&a=showProject&id=<?= $project->id ?>">Voir details</a>
                    </div>

                    <form action="/?c=project&a=deleteProject&id=<?= $project->id ?>" method="post">
                        <input type="submit" name="submit" value="deleteProject">
                    </form>
                </div>

                <?php
            }
        }
        else {?>
            <div>
                <h2>Pour tes projets il faut te log tocard</h2>
            </div>

        <?php
        }?>

    </div>
</div>