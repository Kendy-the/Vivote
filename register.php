<?php
include_once 'C:/wamp64/www/Vivote/config.php';
include_once FUNCTION_PATH.'/back.php';
$page = "s'inscrire";
include_once INCLUDES_PATH.'/header.php';
$error = null;
if(isset($_POST['sb'])){
    $nom = htmlspecialchars(strtolower($_POST['nom']));
    $prenom = htmlspecialchars(strtolower($_POST['prenom']));
    $pass = htmlspecialchars($_POST['pass']);
    $email = htmlspecialchars(strtolower($_POST['email']));

    $saved = register($nom,$prenom, $email,$pass);

    if($saved){
        header("Location:/Vivote/login.php");
    }else{
        $error = "<i class='mb-3 text-center text-danger' style='font-size:13px;'>register Failed, il existe deja un compte avec cette email</i>";
    }
}
?>

<form class="my-4 py-3" style="font-size: 109%; line-height: 1.6;" method="POST" action="">
    <div class="container">
        <div class="my-0 mx-auto login-form">
            <div class="text-center">
                <h2 class="fs-3 mb-2">Organisez votre premier vote</h2>
                <h3 class="fs-3 mb-2">Creer votre compte Vivote</h3>
            </div>

            <div class="d-flex flex-column px-5 border py-5">
                <?php if (isset($error) && !empty($error)) {echo ($error);}?>
                <input type="text" name="nom" placeholder="Votre Nom" required><br>
                <input type="text" name="prenom" placeholder="Votre Prenom" required><br>
                <input type="email" name="email" placeholder="Votre Email" required><br>
                
                <div class="Label-group">
                    <label for="pass">Entre un mot de passe</label>
                    <input class="ms-2" type="password" name="pass" id="" required>   
                </div>

                <div class="label-group d-flex justify-content-between pt-4">
                    <input type="reset" class="btn border secondary-color" value="Annuler">
                    <input type="submit" name='sb' class="btn border primary-color sub-btn" value="Envoyer">
                </div>   
            </div>
        </div>
    </div>
</form>
<?php include_once INCLUDES_PATH.'/footer.php'; ?>