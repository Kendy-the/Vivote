<?php 
include_once 'C:/wamp64/www/Vivote/config.php';
$page = 'Mes votes / nouveau';
include_once INCLUDES_PATH.'/header.php';

if(!isset($_SESSION['auth'])){
    header("Location: /vivote/login.php");
}
?>

<form action="../traitement/votes/create.php" method="POST" style="font-size: 109%; line-height: 1.6;" class="my-5">
    <div class="container">
        <h2 class="fs-3 mb-2 text-center">Creer un vote</h2>

        <div class="my-0 mx-auto login-form border p-4 rounded shadow">

            <div class="d-flex flex-column px-5 py-2">
                <div class="label-group mb-3">
                    <label for="titre">Titre du vote</label><br>
                    <input class="input-width" type="text" name="titre" id="" required><br>
                </div>

                <div class="label-group mb-3">
                    <label for="titre">groupe / organisation (optionnel)</label><br>
                    <input class="input-width" type="text" name="organisme" id=""><br>
                </div>

                <div class="label-group mb-3">
                    <label for="titre">description</label><br>
                    <textarea class="textarea-width" name="description" id="" required></textarea>
                </div>

                <div class="label-group my-3">
                    <h4>Point a voter (Candidats)</h4>
                    <label for="titre">Liste des objectifs (Candidats)</label><br>
                    <i>Objectif separes par un retour a la ligne</i><br>
                    <i>Ceci est un exemple,
                        <div>Ex : Gustave James</div>
                        <div>Rickendy Presume</div>
                        <div>Elso Point-du-jour</div>
                    </i>
                    <textarea class="textarea-width" name="liste_objectifs" id="" required></textarea>
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
                    <textarea class="textarea-width" name="liste_participants" id="" required></textarea>
                </div>


                <div class="label-group d-flex justify-content-between pt-4">
                    <a type="reset" class="btn border secondary-color" href="../index.php">Annuler</a>
                    <input type="submit" name="sb" class="btn border primary-color sub-btn" value="Envoyer">
                </div>

            </div>
        </div>

    </div>

</form>

<?php include_once INCLUDES_PATH.'/footer.php' ?>