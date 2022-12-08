<?php
if (isset($data['user_project'])) {
    $projects = $data['user_project'];
}

?>

<div class="container">
    <form class="createProjectContainer" action="/?c=project&a=addproject" method="post">
        <input type="text" class="padding-1 margin-top-1" name="titleProject" required minlength="4">
        <input type="submit" name="submit" value="addProject">
    </form>

    <div class="projects_container padding-4">
        <?php
        if (isset($_SESSION['user'])) {
            foreach ($projects as $project) { ?>
                <div class="project">
                    <div><h2><?= $project->project_name; ?></h2></div>
                </div>

                <?php
            }
        }
        else {?>
            <div>
                <h2>Pour tes projets faut te log tocard</h2>
            </div>

        <?php
        }?>

    </div>
</div>