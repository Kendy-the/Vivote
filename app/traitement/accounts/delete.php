<?php
include_once 'C:/wamp64/www/Vivote/config.php';
include_once FUNCTION_PATH . '/back.php';

if (isset($_POST['sb'])) {
    $user_id = htmlspecialchars($_GET['id']);
    if(delete_accounts($user_id)){
        session_start();
        session_unset();
        header("Location:/Vivote/login.php");
    }else{
        echo "<b>Erreur lors de la suppression du compte</b>";
    }
}
