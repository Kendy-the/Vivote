<!DOCTYPE html>
<html lang="fr">
<?php session_start(); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/vivote/assets/css/styles.css">

    <title>Vivote | <?= isset($page) ? $page : '' ?></title>
</head>

<body>

    <header>
        <div class="container d-flex justify-content-between py-3">
            <h1 class="h2">Vivote</h1>
            <nav>
                <ul class="nav">
                    <?php if (isset($_SESSION['auth'])) { ?>
                        <li class="mx-2"><a onclick="" href="/Vivote/app/accounts/"><?= $_SESSION['prenom'];?> <?= $_SESSION['nom']; ?></a></li>

                        <li class="mx-2"><a onclick="" href="/Vivote/logout.php">| Deconnection </a></li>
                    <?php } else { ?>
                        <li class="mx-2"><a href="/vivote/index.php">Pour qui ?</a></li>
                        <li class="mx-2"><a href="/vivote/login.php">Connexion</a></li>
                        <li class="mx-2"><a href="/vivote/register.php">Inscription</a></li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </header>