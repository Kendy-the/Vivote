<?php 
include_once 'C:/wamp64/www/Vivote/config.php';
$page = 'va-voter';
include_once FUNCTION_PATH.'/back.php';
include_once INCLUDES_PATH.'/header.php'; 
?>
<div class="container">
    <!-- DONNEE DE LA Table vote -->
    <section class="my-5 p-5 rounded login-form my-0 mx-auto border p-4">
        <h2 class="fs-3 mb-2 text-center">Bienvenue, cher participant.e !</h2>
        <!-- vote form -->
        <?php $result = get_url(); ?>
        <p class='py-5 text-center'><?php if(isset($result)):?>
            Veuillez voter a l'adresse suivant : 
            <?php foreach ($result as $lines):?>
            <a class="primary-text" href="<?= $lines->url; ?>"><?= $lines->url; ?></a>
            <?php endforeach; ?>
            <?php else:  
                echo "<b style='margin:50px 0;'>Une erreur est survenue, veuillez recommencez !</b>";
            ?>
            <?php endif; ?>
        </p>
        <div class="d-flex justify-content-end">
        <a type="reset" class="mx-3 btn border secondary-color" href="/vivote/">Retour</a>
        </div>
    </section>

</div>

<?php include_once INCLUDES_PATH.'/footer.php'; ?>