<?php
if (isset($_SESSION['error'])) {?>
    <div class="error"><?= $_SESSION['error'] ?></div><?php
    unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {?>
    <div class="success"><?= $_SESSION['success'] ?></div><?php
    unset($_SESSION['success']);
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Time Tracking</title>
</head>
<body>
<header class="padding-1">
    <h1><a href="/?c=home">Time tracker</a></h1>
    <div>
        <?php
        if (!isset($_SESSION['user'])) {?>
            <a href="/?c=user&a=register">Inscription</a>/
            <a href="/?c=user&a=login">Login</a><?php
        }else {?>
            <a href="/?c=user&a=profil&id=<?= $_SESSION['user']->id ?>">Profil</a>
            <a href="/?c=user&a=logout">Déconnexion</a><?php
        }
        ?>
    </div>


</header>

<main><?= $html ?></main>


<script src="/build/js/app-bundle.js"></script>
</body>
</html>