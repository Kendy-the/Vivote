<?php
    include_once 'C:/wamp64/www/Vivote/config.php';
    include_once FUNCTION_PATH.'/back.php';

    $prevote_id = intval($_GET['id']);
    if(isset($_POST['sb'])){
        $v = publier_prevotes($prevote_id);

        if($v){
            session_start();
            session_unset();
            header("Location: /vivote/v/invite.php");
        }else{
            echo "Une erreur est survenue lors de la publication !";
        }
    }
    
?>