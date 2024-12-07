<?php
include_once 'C:/wamp64/www/Vivote/config.php';
$page = 'Mes votes / Resultats';
include_once INCLUDES_PATH . '/header.php';
include_once FUNCTION_PATH . '/back.php';

if (!isset($_SESSION['auth'])) {
    header("Location: /vivote/login.php");
}

if (isset($_GET['choix_vote'])) {
    $prevote = searche_by_id('prevote', $_GET['choix_vote']);
    $prevote_id = $_GET['choix_vote'];
    $objectifs = get_participants_election($prevote_id);
}else{
    header("Location:index.php");
}

?>

<div class="container">
    <div class="marge my-5 mx-auto login-form border p-4 rounded">
        <section class="mt-3 mb-1 p-3 rounded">
            <h2 class="fs-3 mb-2 text-center">Resultats</h2>
            <form action="#" method="POST" class="border rounded my-3">
                <?php foreach ($prevote as $res) : ?>
                    <div class="label-group p-2">
                        <b><?= $res->titre ?> |</b> - <i><?= $res->organisme ?></i><br>
                        <p class="mt-2"><?= $res->description ?></p>
                    </div>
                <?php endforeach; ?>
            </form>
        </section>

        <section class="border d-flex justify-content-center bg-light rounded p-4 mx-3 my-4">
            <table class="table table-border table-hover">
                <tr>
                    <th>Objectifs</th>
                    <th class="text-end">nombre de voix</th>
                </tr>
                <?php foreach ($objectifs as $obj) : ?>
                    <tr class="border-bottom mb-2 pb-2">
                        <td><?= $obj->nom ?></td>
                        <td class="text-end"><?= get_nb_voix_prevote_objectifs_id($prevote_id, $obj->objectifs_id) ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </section>
        <div class="d-flex justify-content-end">
            <a type="reset" class="mx-3 btn border secondary-color" href="../../index.php">Retour</a>
        </div>
    </div>
</div>
<?php include_once INCLUDES_PATH . '/footer.php' ?>