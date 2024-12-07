<?php
include_once 'C:/wamp64/www/Vivote/config.php';
$page = 'Mon compte';
include_once FUNCTION_PATH . '/back.php';
include_once INCLUDES_PATH . '/header.php';

$users_id = $_SESSION['id'];
$user = get_accounts($users_id);

if(!isset($_SESSION['auth'])){
    header("Location: /vivote/login.php");
}
?>

<form class="my-4 py-3" style="font-size: 109%; line-height: 1.6;" method="POST" action="../traitement/accounts/update.php">
    <div class="container">
        <div class="my-0 mx-auto login-form">
            <div class="text-center">
                <h3 class="fs-3 mb-2">Mon compte Vivote</h3>
            </div>
            <div class="d-flex flex-column px-5 border py-5">
                    <input type="hidden" name="id" value="<?= $user->id ?>"/>
                    <input type="text" name="nom" placeholder="Votre Nom" value="<?= $user->nom ?>" required><br>
                    <input type="text" name="prenom" placeholder="Votre Prenom" value="<?= $user->prenom ?>" required><br>
                    <input type="email" name="email" placeholder="Votre Email" value="<?= $user->email ?>" required><br>

                    <div class="Label-group">
                        <label class="ms-1" for="pass">Entre un nouveau mot de passe</label>
                        <input class="ms-1" type="password" name="pass" id="">
                    </div>

                    <div class="label-group d-flex justify-content-between pt-4">
                        <a type="reset" class="btn border secondary-color" href="../index.php">Annuler</a>
                        <input type="submit" name="sb" class="btn border primary-color sub-btn" value="Modifier mon compte">
                    </div><br><hr>
                    <div class="label-group d-flex justify-content-end pt-4">
                        <a type="reset" class="btn border btn-danger" href="delete.php?id=<?= $user->id ?>">supprimer mon compte</a>
                    </div>
            </div>
        </div>

    </div>

</form>

<?php include_once INCLUDES_PATH . '/footer.php'; ?>