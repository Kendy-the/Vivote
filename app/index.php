<?php
include_once 'C:/wamp64/www/Vivote/config.php';
$page = 'Mes votes';
include_once INCLUDES_PATH . '/header.php';
include_once FUNCTION_PATH . '/back.php';
$users_id = $_SESSION['id'];

if (!isset($_SESSION['auth'])) {
    header("Location: /vivote/login.php");
}
?>

<div class="container">
    <!-- DONNEE DE LA Table vote -->
    <section class="my-3 p-3 rounded">
        <div class="d-flex justify-content-between flex-wrap">
            <a class="mt-2 primary-text btn border sub-btn" href="votes/new.php"><i class='pe-2 bx bxs-plus-circle'></i>Ajouter une vote</a>
            <a class="mt-2 btn border primary-color sub-btn" href="votes/r/index.php">Aller aux Resultats</a>
        </div>

        <!-- vote form -->
        <?php $results = get_prevotes_id($users_id); ?>
        <?php foreach ($results as $lines) : ?>
            <?php $i = 0;
            if ($i == 0) {
                $prevote_id = $lines->id;
            }
            $i++; ?>
            <form action="traitement/votes/publier.php?id=<?= $lines->id ?>" method="POST" class="border rounded my-3">
                <div class="label-group p-2">

                    <b><?= $lines->titre ?></b> - <i>| <?= $lines->organisme ?></i><br>
                    <p class="mt-2"><?= $lines->description ?></p>

                    <?php if ($lines->statut == 0) : ?>
                        <span>Statut : Non publier</span>
                    <?php elseif ($lines->statut == 1) :  ?>
                        <span>Statut : Publier</span>
                    <?php elseif ($lines->statut == 2) :  ?>
                        <span>Statut : Terminer</span>
                    <?php endif; ?>
                </div>

                <div class="label-group d-flex mt-1 p-2">
                    <?php if ($lines->statut != 2) : ?>
                        <?php if ($lines->statut == 1) : ?>
                            <a class="me-3 btn border primary-color sub-btn" href="votes/terminer.php?id=<?= $lines->id ?>">Terminer</a>
                        <?php else : ?>
                            <a class="me-1 bx bx-edit-alt cursor-pointer me-3 border rounded btn border bg-secondary primary-text" title="modifier" style="width:65px; height:38px;" href="votes/edit.php?id=<?= $lines->id ?>"></a>
                        <?php endif; ?>
                    <?php elseif ($lines->statut == 2) : ?>
                        <a class="me-3 btn border primary-color sub-btn" href="votes/r/results.php?choix_vote=<?= $lines->id ?>">Aller aux Resultats</a>
                    <?php endif; ?>
                    <?php if ($lines->statut == 0) : ?>
                        <input name="sb" class="btn border primary-color sub-btn" type="submit" value="Publier">
                    <?php endif; ?>
                </div>

                <div class="label-group d-flex justify-content-between bg-light p-2">
                    <i>Nombre d'electeur : <?= get_nb_participants($lines->id) ?></i>
                    <a class="me-1 bx bx-task-x cursor-pointer text-danger" title="supprimer" href="votes/delete.php?id=<?= $lines->id ?>"></a>
                </div>
            </form>
        <?php endforeach; ?>

        <?php if (empty($results)) : ?>
            <div class="my-0 mx-auto login-form border p-5 rounded shadow">
                <div class="d-flex flex-column px-5 py-2">
                    <h2 class="fs-3 mb-2 text-center">Bienvenue !</h2>
                    <div class="label-group my-5">
                        <p>Vous n'avez pas encore creer de vote, veuillez creer un nouveau vote !</p>
                    </div>
                    <div class="label-group d-flex justify-content-center pt-4">
                        <a href="votes/new.php" class="btn border primary-color sub-btn">Creer un vote</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </section>
</div>
<?php include_once INCLUDES_PATH . '/footer.php'; ?>