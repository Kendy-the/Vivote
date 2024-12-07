<?php 
include_once 'C:/wamp64/www/Vivote/config.php';
$page = 'Mon Compte / Supprimer';
include_once INCLUDES_PATH.'/header.php'; 

if(!isset($_SESSION['auth'])){
    header("Location: /vivote/login.php");
}
?>

<form action="../traitement/accounts/delete.php?id=<?= $_GET['id']; ?>" method="POST" style="font-size: 109%; line-height: 1.6;" class="my-5">
    <div class="container">
        <h2 class="fs-3 mb-2 text-center">Supprimer</h2>
        <div class="my-0 mx-auto login-form border p-5 rounded shadow">

            <div class="d-flex flex-column px-5 py-2">

                <div class="label-group my-3">
                    <p>Si vous supprimez ce compte, toutes ses informations (vos informations de compte utilisateurs, vos electeurs, vos objectifs ou candidats, vos vote et resultats) seront detruites voulez-vous vraiment supprimer ce compte ?</p>
                </div>


                <div class="label-group d-flex justify-content-between pt-4">
                    <a type="reset" class="btn border secondary-color" href="../index.php">Annuler</a>
                    <input type="submit" name="sb" class="btn border btn-danger sub-btn" value="Supprimer">
                </div>
            </div>
        </div>
    </div>
</form>

<?php include_once INCLUDES_PATH.'/footer.php' ?>