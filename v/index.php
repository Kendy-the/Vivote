<?php 
include_once 'C:/wamp64/www/Vivote/config.php';
$page = 'vote-success';
include_once INCLUDES_PATH.'/header.php'; 
?>

<div class="container">
    <!-- DONNEE DE LA Table vote -->
    <section class="my-5 p-5 rounded login-form my-0 mx-auto border p-4">
        <h2 class="fs-3 mb-2 text-center">Merci !</h2>
        <!-- vote form -->

        <p>Votre vote a bien ete prise en compte.
            veuillez consulter les resultats a partir du liens 
            resultats que vous avez recu par mail.

            ou a partir du lien ci-dessous<br>

            <a class="primary-text" href="http://localhost/vivote/v/results/">Ici : http://localhost/vivote/v/results/</a>
        </p>
        <div class="d-flex justify-content-end">
        <a type="reset" class="mx-3 btn border secondary-color" href="/vivote/">Retour</a>
        </div>
    </section>

</div>

<?php include_once INCLUDES_PATH.'/footer.php'; ?>