<?php
    include_once 'C:/wamp64/www/Vivote/config.php';
    include_once FUNCTION_PATH.'/back.php';
    
    $prevote_id = intval($_GET['id']);
    if(isset($_POST['sb'])){
        if(delete_vote($prevote_id)){
            header("Location: ../../");
        }else{
            echo "Une erreur est survenue lors de la suppression du vote !";
        }
    }
?>