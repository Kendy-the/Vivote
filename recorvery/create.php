<?php
include_once 'C:/wamp64/www/Vivote/config.php';
include_once FUNCTION_PATH.'/back.php';

if(isset($_POST['sb'])){
    $nom = htmlspecialchars(strtolower($_POST['nom']));
    $prenom = htmlspecialchars(strtolower($_POST['prenom']));
    $pass = htmlspecialchars($_POST['pass']);
    $email = htmlspecialchars(strtolower($_POST['email']));

    $saved = register($nom,$prenom, $email,$pass);

    if($saved){
        header("Location:/Vivote/login.php");
    }else{
        $err = "<i class='mt-3 text-center text-danger' style='font-size:13px;'>register Failed, il existe deja un compte avec cette email</i>";
        header("Location:/Vivote/register.php?$err");
    }
}else{
    echo "<b>Veuillez remplir les champs</b>";
}
?>