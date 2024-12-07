<?php
include_once 'C:/wamp64/www/Vivote/config.php';
include_once FUNCTION_PATH . '/back.php';

if (isset($_POST['sb'])) {
    $user_id = htmlspecialchars($_POST['id']);
    $nom = htmlspecialchars(strtolower($_POST['nom']));
    $prenom = htmlspecialchars(strtolower($_POST['prenom']));
    $pass = htmlspecialchars($_POST['pass']);
    $email = htmlspecialchars(strtolower($_POST['email']));

    $saved = null;

    if (empty($pass)) {
        $saved = update_accounts($nom, $prenom, $email, $user_id);
    } else {
        $saved = update_accounts_pass($nom, $prenom, $email, $pass, $user_id);
    }

    if ($saved) {
        session_start();
        session_unset();
        header("Location:/Vivote/login.php");
    }
} else {
    echo "<b>Veuillez remplir les champs</b>";
}
