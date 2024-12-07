<?php
include_once 'C:/wamp64/www/Vivote/config.php';
$page = 'Mes votes / edit';
include_once FUNCTION_PATH . '/back.php';
include_once INCLUDES_PATH . '/header.php';

if(!isset($_SESSION['auth'])){
    header("Location: /vivote/login.php");
}
?>
<?php
$prevote_id = $_GET['id'];
$votes = get_prevotes_election($prevote_id);
$objectifs = get_participants_election($prevote_id);
$participants = get_electeurs_election($prevote_id);
?>
<form action="../traitement/votes/update.php?id=<?= $_GET['id']; ?>" method="POST" style="font-size: 109%; line-height: 1.6;" class="my-5">
    <div class="container">
        <h2 class="fs-3 mb-2 text-center">Modifier un vote</h2>

        <div class="my-0 mx-auto login-form border p-4 rounded shadow">
                <?php foreach ($votes as $vote) : ?>
                    <div class="label-group mb-3">
                        <label for="titre">Titre du vote</label><br>
                        <input class="input-width" type="text" name="titre" id="" value="<?= $vote->titre ?>"><br>
                    </div>

                    <div class="label-group mb-3">
                        <label for="titre">groupe / organisation (optionnel)</label><br>
                        <input class="input-width" type="text" name="organisme" id="" value="<?= $vote->organisme ?>"><br>
                    </div>

                    <div class="label-group mb-3">
                        <label for="titre">description</label><br>
                        <textarea class="textarea-width" name="description" id=""><?= $vote->description ?></textarea>
                    </div>
                <?php endforeach; ?>

                <div class="label-group my-3">
                    <h4>Point a voter</h4>
                    <label for="titre">Liste des objectifs(Candidats)</label><br>
                    <i>Objectif (Candidats) separes par un retour a la ligne</i><br>
                    <i>Ceci est un exemple
                        <div>Ex : Gustave James</div>
                        <div>Rickendy Presume</div>
                        <div>Elso Point-du-jour</div>
                    </i>
                    <textarea class="textarea-width" name="liste_objectifs" id=""><?php foreach ($objectifs as $objectif) : ?><?= $objectif->nom."\n"; ?><?php endforeach; ?></textarea>
                </div>

                <div class="label-group my-3">
                    <h4>Les participants a invite a voter</h4>
                    <label for="titre">Liste des email des participants</label><br>
                    <i>email separes par un retour a la ligne</i><br>
                    <i>Ceci est un exemple,
                        <div>Ex : gustavejames@gmail.com</div>
                        <div>rickendypresume@gmail.com</div>
                        <div>Elsopoint@gmail.com</div>
                    </i>
                    <textarea class="textarea-width" name="liste_participants" id=""><?php foreach ($participants as $participant) : ?><?= $participant->email."\n" ?><?php endforeach; ?></textarea>
                </div>

                <div class="label-group d-flex justify-content-between pt-4">
                    <a type="reset" class="btn border secondary-color" href="../index.php">Annuler</a>
                    <input type="submit" name='sb' class="btn border primary-color sub-btn" value="Modifier">
                </div>
            </div>
        </div>
    </div>
</form>
<?php include_once INCLUDES_PATH . '/footer.php' ?>