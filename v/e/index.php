<?php
$page = 'auth-voter';
include_once 'C:/wamp64/www/Vivote/config.php';
include_once FUNCTION_PATH . '/back.php';
include_once INCLUDES_PATH . '/header.php'
?>
<?php
$error = null;
$prevote = get_prevotes_invite();
if (isset($_POST['choix_vote'])) {

    $email = htmlspecialchars($_POST['email']);
    $choix_vote = htmlspecialchars($_POST['choix_vote']);
    $error = participants_verify($email, $choix_vote);
}
?>
<form method="POST" action="" class="my-5">
    <div class="container">
        <div class="marge my-5 mx-auto login-form border p-4 rounded">
            <div class="d-flex flex-column py-2">
                <h3 class="h4 text-center">Vote confidentiel</h3>
                <div class="label-group mt-3 p-3 border rounded bg-light">

                    <div>
                        <?php if (!empty($prevote)) : ?>
                            <h3 class="h5">Choix du vote a participer</h3>
                            <?php foreach ($prevote as $line) : ?>
                                <input required type="radio" name="choix_vote" value="<?= $line->id ?>">
                                <label for=""><?= $line->titre ?></label><br>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <p class="text-center pt-3">Aucun vote disponible !</p>
                        <?php endif; ?>
                    </div>

                    <div class="mt-4">
                        <?php if (!empty($prevote)) : ?>
                            <input required class="rounded" type="email" name="email" placeholder="Entrer Votre email" id="">
                        <?php endif; ?>
                        <i>
                            <?php
                            if (isset($error) && !empty($error)) {
                                echo ($error);
                            }
                            ?>
                        </i>
                    </div>

                </div>

                <div class="label-group d-flex justify-content-between mt-3 py-5">
                    <?php if (empty($prevote)) : ?>
                        <a type="reset" class="mx-3 btn border secondary-color" href="/vivote/">Retour</a>
                    <?php else : ?>
                        <a type="reset" class="mx-3 btn border primary-color" href="/vivote/">Retour</a>
                        <input type="submit" name="sb" class="btn border primary-color sub-btn float-end" value="Envoyer">
                    <?php endif; ?>
                    
                </div>

            </div>
        </div>
    </div>
</form>
<?php include_once INCLUDES_PATH . '/footer.php' ?>