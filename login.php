<?php
$page = 'login';
include_once 'C:/wamp64/www/Vivote/config.php';
include_once INCLUDES_PATH.'/header.php';
include_once FUNCTION_PATH.'/back.php'; 
?>
<?php
$error = null;

if(isset($_POST['sb'])){

    $email = htmlspecialchars($_POST['email']);
    $pass = htmlspecialchars($_POST['pass']);
    
    $login = login($email, $pass);

    if(!$login){
        $error = "<i class='mt-3 text-center text-danger' style='font-size:13px;'>Login Failed, email ou mot de passe incorrect</i>";
    }else{
        $_SESSION['auth'] = TRUE;
        $_SESSION['id'] = $login->id;
        $_SESSION['prenom'] = $login->prenom;
        $_SESSION['nom'] = $login->nom;
        $_SESSION['email'] = $login->email;
        header("Location:app/");
    }
}
?>
<form class="my-5 py-5" style="font-size: 109%; line-height: 1.6;" method="POST" action="">
    <div class="container">
        <div class="my-0 mx-auto login-form">
            <div class="text-center">
                <h2 class="fs-3 mb-2">Connecter a votre compte</h2>
            </div>

            <div class="d-flex flex-column px-5 border py-5">
                <input type="email" name="email" placeholder="Votre Email" required><br>
                
                <div class="Label-group">
                    <label for="pass">Entre un mot de passe</label>
                    <input class="ms-2" type="password" name="pass" id="" required>   
                </div>
                <?php if (isset($error) && !empty($error)) {echo ($error);}?>
                <div class="label-group d-flex justify-content-between pt-4">
                    <input type="reset" class="btn border secondary-color" value="Annuler">
                    <input type="submit" name="sb" class="btn border primary-color sub-btn" value="Envoyer">
                </div>
                <div class=" mt-4 text-end" style='font-size:15px;'>Vous n'avez pas encore de compte,<a href="register.php" class="text-success px-2">s'inscrire gratuitement !</a></div>
            </div>
        </div>
        
    </div>

</form>
<?php include_once INCLUDES_PATH.'/footer.php'; ?>