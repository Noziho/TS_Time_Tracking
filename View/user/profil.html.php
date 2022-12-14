<?php

if (isset($data['user'])) {
    $user = $data['user'];
}
?>

<div class="container">
    <div id="profil_container">
        <h2>Profil</h2>
        <p><?= $user->email ?></p>
        <form action="/?c=user&a=delete&id=<?= $user->id ?>" method="post">
            <input type="submit" name="submit" class="deleteProjectButton" value="Supprimer le compte">
        </form>
    </div>
</div>
