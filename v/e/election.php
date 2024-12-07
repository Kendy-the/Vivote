<?php 
include_once 'C:/wamp64/www/Vivote/config.php';
$page = 'je vote';
include_once INCLUDES_PATH.'/header.php';
include_once FUNCTION_PATH.'/back.php';
?>
<?php
$prevote_id = $_GET['pre_id'];
$participant_id = $_GET['par_id'];

if (isset($_POST['sb'])) {

    $choix_objectifs = htmlspecialchars($_POST['choix_objectif']);
    $vote = set_vote($prevote_id, $choix_objectifs, $participant_id);

    if ($vote) {
        header("Location: ../");
    } else {
        echo ("<b>Erreur, vote non prise en charge !</b>");
    }
}
$result = get_prevotes_election($prevote_id);
$objectif = get_participants_election($prevote_id);
?>

<form action="" method="POST" class="my-5">
    <div class="container">
        <div class="my-0 mx-auto login-form border p-4 rounded">
            <?php if (participants_verify_election($prevote_id, $participant_id)): ?>
                <div class="d-flex flex-column py-2">
                    <div class="label-group p-3 border rounded bg-light">
                        <h4>Vous etes deja vote a ce vote !</h4>
                    </div>

                    <p class="mt-5">
                        veuillez consulter les resultats a partir du liens
                        resultats que vous avez recu par mail.

                        ou a partir du lien ci-dessous<br>

                        <a class="primary-text" href="http://localhost/vivote/v/results/">Ici : http://localhost/vivote/v/results/</a>
                    </p>
                    <div class="d-flex justify-content-end">
                        <a type="reset" class="mx-3 btn border secondary-color" href="/vivote/">Retour</a>
                    </div>
                </div>
            <?php else : ?>
                <div class="label-group p-3 border rounded bg-light">
                    <?php foreach ($result as $res): ?>
                        <h4><?= $res->titre ?></h4>
                        <i>
                            <div>Groupe / organisation : <?= $res->organisme ?></div>
                        </i>
                        <hr>
                        <p><?= $res->description ?></p>
                    <?php endforeach; ?>
                </div>

                <div class="label-group mt-3 p-3 border rounded bg-light">
                    <i>
                        <div>Crochez l'objectifs que vous approuvez</div>
                        <div>Vous pouvez faire un (1) seul choix</div>
                    </i>
                    <hr>

                    <?php foreach ($objectif as $line): ?>
                        <div><!-- nom - php -->
                            <input type="radio" name="choix_objectif" value="<?= $line->objectifs_id ?>">
                            <label for=""><?= $line->nom ?></label><br>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="label-group d-flex justify-content-between mt-3">
                    <a type="reset" class="mx-3 btn border secondary-color" href="/vivote/">Retour</a>
                    <input type="submit" name="sb" class="btn border primary-color sub-btn" value="Je vote">
                </div>
            <?php endif; ?>
        </div>
    </div>
    </div>

</form>

<?php include_once INCLUDES_PATH.'/footer.php' ?>