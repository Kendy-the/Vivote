<?php 
include_once 'C:/wamp64/www/Vivote/config.php';
$page = 'Auth-Resultats';
include_once FUNCTION_PATH.'/back.php';
include_once INCLUDES_PATH.'/header.php';

if(isset($_GET['err'])){
    $err = $_GET['err'];
}

?>
<form method="GET" action="res.php" class="my-5">
    <div class="container">
        <div class="marge my-5 mx-auto login-form border p-4 rounded">
            <div class="d-flex flex-column py-2">
            <h3 class="h4 text-center">Vers les resultats</h3>
                <div class="label-group mt-3 p-3 border rounded bg-light">

                    <div>
                        <?php $prevote = get_prevotes(); ?>
                        <h3 class="h5 text-center">Choix du vote a voir le resultat</h3>
                        <?php foreach ($prevote as $line) : ?>
                            <input type="radio" name="choix_vote" value="<?= $line->id ?>">
                            <label for=""><?= $line->titre ?></label><br>
                        <?php endforeach; ?>
                    </div>

                    <div class="mt-4">
                        <?php if (!empty($prevote)) : ?>
                            <input required class="rounded" type="email" name="email" placeholder="Entrer Votre email" id="">
                        <?php endif; ?>
                        <i>
                            <?php
                            if (isset($err) && !empty($err)) {
                                echo ($err);
                            }
                            ?>
                        </i>
                    </div>

                </div>
                <div class="label-group d-flex justify-content-between mt-3 py-5">
                <a type="reset" class="mx-3 btn border primary-color" href="/vivote/">Retour</a>
                    <input type="submit" name="sb" class="btn border primary-color sub-btn float-end" value="Envoyer">
                </div>
            </div>
        </div>
    </div>
</form>
<?php include_once INCLUDES_PATH.'/footer.php'; ?> 